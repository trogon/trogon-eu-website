<?php
namespace App\Command;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpClient\Exception\ClientException;
use Symfony\Component\HttpClient\Exception\TransportException;

use Symfony\Bridge\Doctrine\RegistryInterface;

use Twig\Environment;

use App\Entity\News;
use App\Entity\Project;

use App\Service\BitbucketClientService;
use App\Service\GithubClientService;

class UpdateProjectNewsCommand extends Command
{
    protected static $defaultName = 'app:cron:update-project-news';
    private static $bitbucketDateFormat = 'Y-m-d\TH:i:sP';

    private $logger;
    private $bitbucketClient;
    private $githubClient;
    private $doctrine;

    public function __construct(
        LoggerInterface $logger,
        RegistryInterface $doctrine,
        Environment $twig,
        BitbucketClientService $bitbucketClient,
        GithubClientService $githubClient)
    {
        $this->logger = $logger;
        $this->doctrine = $doctrine;
        $this->twig = $twig;
        $this->bitbucketClient = $bitbucketClient;
        $this->githubClient = $githubClient;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Updates project data from third-party services.')
            ->setHelp('This command updates project data stored in local database from third-party services eg. github, bitbucket etc.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Project ~Ara sketch~ News Update',
            '============',
            '',
        ]);

        $output->writeln('Getting stored projects...');
        $projects = $this->doctrine
            ->getRepository(Project::class)
            ->findAllIndexedByFullName();

        $output->writeln('Getting stored news...');
        $news_list = $this->doctrine
            ->getRepository(News::class)
            ->findAllIndexedByReference();

        $entityManager = $this->doctrine
            ->getManager();

        $auth_token = $this->getAuthToken($output);
        if ($auth_token == null)
        {
            exit;
        }

        $responses = [];
        $response_contexts = [];

        foreach ($projects as $project_fullname => $project) {
            if ($project->getProvider() != 'bitbucket') continue;
            $response = $this->bitbucketClient->getTagsResponse($auth_token, $project_fullname);
            $url = $response->getInfo('url');
            $response_contexts[$url] = $project;
            $responses[] = $response;
        }

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
                        $tagref = "$projectref;tag:" . $tagData['name'];

                        if (!array_key_exists($tagref, $news_list)) {
                            $news = $this->createNews($output, $tagref, $tagData);
                        } else {
                            $news = $news_list[$tagref];
                        }
        
                        $this->updateNewsContent($output, $tagref, $news, $project, $tagData);
        
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

        $output->writeln('Process finished.');
    }

    private function getAuthToken($output)
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

    private function createNews($output, $tagref, $tagData)
    {
        $output->writeln("New project news $tagref...");

        $news = new News();
        $news->setReference($tagref);
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

    private function updateNewsContent($output, $tagref, $news, $project, $tagData)
    {
        $output->writeln("Update project news $tagref...");

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
