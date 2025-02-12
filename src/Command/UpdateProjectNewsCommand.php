<?php

namespace App\Command;

use Psr\Log\LoggerInterface;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpClient\Exception\ClientException;
use Symfony\Component\HttpClient\Exception\TransportException;

use Doctrine\Persistence\ManagerRegistry;

use Twig\Environment;

use App\Entity\News;

use App\Repository\NewsRepository;
use App\Repository\ProjectRepository;

use App\Service\BitbucketClientService;
use App\Service\GithubClientService;

#[AsCommand(name: 'app:cron:update-project-news', description: 'Updates project data from third-party services.')]
class UpdateProjectNewsCommand extends Command
{
    private static $bitbucketDateFormat = 'Y-m-d\TH:i:sP';
    private static $ghDateFormat = 'Y-m-d\TH:i:s\Z';

    public function __construct(
        private LoggerInterface $logger,
        private ManagerRegistry $doctrine,
        private NewsRepository $newsDb,
        private ProjectRepository $projectDb,
        private Environment $twig,
        private BitbucketClientService $bitbucketClient,
        private GithubClientService $githubClient
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setHelp('This command updates project data stored in local database from third-party services eg. github, bitbucket etc.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([
            'Project News Update',
            '============',
            '',
        ]);

        $output->writeln('Getting stored news...');
        $news_list = $this->newsDb
            ->findAllIndexedByReference();

        $entityManager = $this->doctrine
            ->getManager();

        $this->updateBitbucketNews($output, $entityManager, $news_list);

        // Not ready to be used (pulling too many queries from GitHub REST API)
        //$this->updateGithubNews($output, $entityManager, $news_list);

        $output->writeln('Process finished.');

        return 0;
    }

    private function getBitbucketAuthToken($output)
    {
        $output->writeln('Requesting authentication for bitbucket...');
        $response = $this->bitbucketClient->getAccessTokenResponse();

        try {
            $authResponse = $response->toArray();
            return $authResponse['access_token'];
        } catch (ClientException $ex) {
            $this->logger->warning($ex);
            $this->logger->warning(json_encode($response->getInfo('debug')));
        } catch (TransportException $ex) {
            $this->logger->warning($ex);
            $this->logger->warning(json_encode($response->getInfo('debug')));
        }

        return null;
    }

    private function updateBitbucketNews(OutputInterface $output, $entityManager, $news_list)
    {
        $auth_token = $this->getBitbucketAuthToken($output);
        if ($auth_token == null) {
            return false;
        }

        $output->writeln('Getting stored bitbucket projects...');
        $projects = $this->projectDb
            ->findByProviderIndexedByFullName('bitbucket');

        $responses = [];
        $response_contexts = [];
        foreach ($projects as $project_fullname => $project) {
            if ($project->getIsPrivate() == true) continue;
            $response = $this->bitbucketClient->getTagsResponse($project_fullname, $auth_token);
            $url = $response->getInfo('url');
            $response_contexts[$url] = $project;
            $next_responses[] = $response;
        }

        $output->writeln('Getting project tags from bitbucket...');
        while (!empty($next_responses)) {
            $responses = $next_responses;
            $next_responses = [];
            foreach ($this->bitbucketClient->stream($responses) as $response => $chunk) {
                try {
                    if ($chunk->isTimeout()) {
                        // ... decide what to do when a timeout occurs
                        // if you want to stop a response that timed out, don't miss
                        // calling $response->cancel() or the destructor of the response
                        // will try to complete it one more time
                    } elseif ($chunk->isFirst()) {
                        // if you want to check the status code, you must do it when the
                        // first chunk arrived, using $response->getStatusCode();
                        // not doing so might trigger an HttpExceptionInterface
                    } elseif ($chunk->isLast()) {
                        // ... do something with $response
                        $responseArray = $response->toArray();

                        $url = $response->getInfo('url');
                        $project = $response_contexts[$url];
                        $projectref = "{$project->getProvider()}:{$project->getFullname()}";

                        foreach ($responseArray['values'] as $tagData) {
                            $tagref = "{$projectref};tag:{$tagData['name']}";

                            if (!array_key_exists($tagref, $news_list)) {
                                $news = $this->createBitbucketNews($output, $project, $tagref, $tagData);
                            } else {
                                $news = $news_list[$tagref];
                            }

                            $this->updateBitbucketNewsContent($output, $news, $project, $tagData);

                            if (!array_key_exists($tagref, $news_list)) {
                                $entityManager->persist($news);
                            }
                        }

                        $output->writeln("Saving project news for $projectref...");
                        $entityManager->flush();

                        if (isset($responseArray['next'])) {
                            $output->writeln('Next page - getting project tags from bitbucket...');
                            $next_responses[] = $this->bitbucketClient->getTagsResponse(
                                $project->getFullname(),
                                $auth_token,
                                $responseArray['next']
                            );
                        }
                    } else {
                        // $chunk->getContent() will return a piece
                        // of the response body that just arrived
                    }
                } catch (ClientException $ex) {
                    $this->logger->warning($ex);
                    $this->logger->warning(json_encode($response->getInfo('debug')));
                } catch (TransportException $ex) {
                    $this->logger->warning($ex);
                    $this->logger->warning(json_encode($response->getInfo('debug')));
                }
            }
        }
    }

    private function createBitbucketNews($output, $project, $tagref, $tagData)
    {
        $output->writeln("New project news {$tagref}...");

        $news = new News();
        $news->setReference($tagref);
        $news->setProject($project);
        $createdOn = \DateTime::createFromFormat(self::$bitbucketDateFormat, $tagData['date']);
        if ($createdOn !== false) {
            $news->setCreatedOn($createdOn);
        } else {
            $output->writeln('Invalid date "' . $tagData['date'] . '". Falling back to commit date.');
            $createdOn = \DateTime::createFromFormat(self::$bitbucketDateFormat, $tagData['target']['date']);
            if ($createdOn !== false) {
                $news->setCreatedOn($createdOn);
            } else {
                $output->writeln('Invalid commit date "' . $tagData['target']['date'] . '".');
            }
        }
        return $news;
    }

    private function updateBitbucketNewsContent($output, $news, $project, $tagData)
    {
        $output->writeln("Update project news content {$news->getReference()}...");

        $summary = $this->twig->render('news/templates/new-release-summary.html.twig', [
            'project_name' => $project->getName(),
            'version' => $tagData['name']
        ]);
        $news->setSummary($summary);

        $content = $this->twig->render('news/templates/new-release-content.html.twig', [
            'project_name' => $project->getName(),
            'version' => $tagData['name']
        ]);
        $news->setContent($content);

        $title = $this->twig->render('news/templates/new-release-title.html.twig', [
            'project_name' => $project->getName(),
            'version' => $tagData['name']
        ]);
        $news->setTitle($title);
    }

    private function updateGithubNews(OutputInterface $output, $entityManager, $news_list)
    {
        $output->writeln('Getting stored github projects...');
        $projects = $this->projectDb
            ->findByProviderIndexedByFullName('github');

        $responses = [];
        $response_contexts = [];
        foreach ($projects as $project_fullname => $project) {
            if ($project->getIsPrivate() == true) continue;
            $response = $this->githubClient->getTagsResponse($project_fullname);
            $url = $response->getInfo('url');
            $response_contexts[$url] = $project;
            $next_responses[] = $response;
        }

        $output->writeln('Getting project tags from github...');
        while (!empty($next_responses)) {
            $responses = $next_responses;
            $next_responses = [];
            foreach ($this->githubClient->stream($responses) as $response => $chunk) {
                try {
                    if ($chunk->isTimeout()) {
                        // ... decide what to do when a timeout occurs
                        // if you want to stop a response that timed out, don't miss
                        // calling $response->cancel() or the destructor of the response
                        // will try to complete it one more time
                    } elseif ($chunk->isFirst()) {
                        // if you want to check the status code, you must do it when the
                        // first chunk arrived, using $response->getStatusCode();
                        // not doing so might trigger an HttpExceptionInterface
                    } elseif ($chunk->isLast()) {
                        // ... do something with $response
                        $responseArray = $response->toArray();

                        $url = $response->getInfo('url');
                        $project = $response_contexts[$url];
                        $projectref = "{$project->getProvider()}:{$project->getFullname()}";

                        foreach ($responseArray as $tagData) {
                            $tagref = "{$projectref};tag:{$tagData['name']}";

                            if (!array_key_exists($tagref, $news_list)) {
                                $news = $this->createGithubNews($output, $project, $tagref, $tagData);
                            } else {
                                $news = $news_list[$tagref];
                            }

                            $this->updateGithubNewsDate($output, $news, $project, $tagData);
                            $this->updateGithubNewsContent($output, $news, $project, $tagData);

                            if (!array_key_exists($tagref, $news_list)) {
                                $entityManager->persist($news);
                            }
                        }

                        $output->writeln("Saving project news for $projectref...");
                        $entityManager->flush();
                    } else {
                        // $chunk->getContent() will return a piece
                        // of the response body that just arrived
                    }
                } catch (ClientException $ex) {
                    $this->logger->warning($ex);
                    $this->logger->warning(json_encode($response->getInfo('debug')));
                } catch (TransportException $ex) {
                    $this->logger->warning($ex);
                    $this->logger->warning(json_encode($response->getInfo('debug')));
                }
            }
        }
    }

    private function createGithubNews($output, $project, $tagref, $tagData)
    {
        $output->writeln("New project news {$tagref}...");

        $news = new News();
        $news->setReference($tagref);
        $news->setProject($project);
        return $news;
    }

    private function updateGithubNewsDate($output, $news, $project, $tagData)
    {   // Requires additional query for link $tagData['commit']['url'] or request commit data by sha $tagData['commit']['sha']
        $output->writeln("Update project news time {$news->getReference()}...");

        $createdOn = \DateTime::createFromFormat(self::$ghDateFormat, $tagData['commit']['url']);
        if ($createdOn !== false) {
            $news->setCreatedOn($createdOn);
        } else {
            $output->writeln('Invalid date "' . $tagData['commit']['url'] . '". Falling back to commit date.');
            $createdOn = \DateTime::createFromFormat(self::$ghDateFormat, $tagData['commit']['sha']);
            if ($createdOn !== false) {
                $news->setCreatedOn($createdOn);
            } else {
                $output->writeln('Invalid commit date "' . $tagData['commit']['sha'] . '".');
                $createdOn = new \DateTime();
                $news->setCreatedOn($createdOn);
            }
        }
    }

    private function updateGithubNewsContent($output, $news, $project, $tagData)
    {
        $output->writeln("Update project news content {$news->getReference()}...");

        $summary = $this->twig->render('news/templates/new-release-summary.html.twig', [
            'project_name' => $project->getName(),
            'version' => $tagData['name']
        ]);
        $news->setSummary($summary);

        $content = $this->twig->render('news/templates/new-release-content.html.twig', [
            'project_name' => $project->getName(),
            'version' => $tagData['name']
        ]);
        $news->setContent($content);

        $title = $this->twig->render('news/templates/new-release-title.html.twig', [
            'project_name' => $project->getName(),
            'version' => $tagData['name']
        ]);
        $news->setTitle($title);
    }
}
