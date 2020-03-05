<?php
namespace App\Command;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpClient\Exception\ClientException;
use Symfony\Component\HttpClient\Exception\TransportException;

use Symfony\Bridge\Doctrine\RegistryInterface;

use App\Entity\Project;

use App\Service\BitbucketClientService;
use App\Service\GithubClientService;

class UpdateProjectsCommand extends Command
{
    protected static $defaultName = 'app:cron:update-projects';
    private static $bitbucketDateFormat = 'Y-m-d\TH:i:s.uP';
    private static $ghDateFormat = 'Y-m-d\TH:i:s\Z';

    private $logger;
    private $bitbucketClient;
    private $githubClient;
    private $doctrine;

    public function __construct(
        LoggerInterface $logger,
        RegistryInterface $doctrine,
        BitbucketClientService $bitbucketClient,
        GithubClientService $githubClient)
    {
        $this->logger = $logger;
        $this->doctrine = $doctrine;
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
            'Projects Update',
            '============',
            '',
        ]);

        $output->writeln('Getting stored projects...');
        $projects = $this->doctrine
            ->getRepository(Project::class)
            ->findAllIndexedByFullName();
        
        $entityManager = $this->doctrine
            ->getManager();

        $this->updateBitbucketProjects($output, $entityManager, $projects);

        $this->updateGithubProjects($output, $entityManager, $projects);

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

    private function updateBitbucketProjects(OutputInterface $output, $entityManager, $projects)
    {
        $auth_token = $this->getAuthToken($output);
        if ($auth_token == null)
        {
            return false;
        }

        $next_responses = [];
        $next_responses[] = $this->bitbucketClient->getRepositoriesResponse($auth_token);

        $output->writeln('Getting projects from bitbucket...');
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
                        $response->cancel();

                        $output->writeln('Processing projects from bitbucket...');
                        foreach ($responseArray['values'] as $projectData) {
                            $project = $this->createBitbucketProject(
                                $output, $projectData, $entityManager, $projects
                            );
                            $this->updateBitbucketProject(
                                $output, $projectData, $project
                            );
                        }

                        $output->writeln('Saving changed projects from bitbucket...');
                        $entityManager->flush();

                        if (isset($responseArray['next'])) {
                            $output->writeln('Next page - getting projects from bitbucket...');
                            $next_responses[] = $this->bitbucketClient->getRepositoriesResponse(
                                $auth_token, $responseArray['next']);
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

    private function createBitbucketProject(OutputInterface $output, $projectData, $entityManager, $projects)
    {
        $fullname = $projectData['full_name'];
        if (!array_key_exists($fullname, $projects)) {
            $output->writeln("Create project {$fullname} from bitbucket...");
            $project = new Project();
            $project->setProvider('bitbucket');
            $project->setFullName($fullname);
            $createdOn = \DateTime::createFromFormat(self::$bitbucketDateFormat, $projectData['created_on']);
            $project->setCreatedOn($createdOn);
            $repoLink = "https://www.bitbucket.com/{$fullname}";
            $project->setRepoLink($repoLink);
            $entityManager->persist($project);
            return $project;
        } else {
            return $projects[$fullname];
        }
    }

    private function updateBitbucketProject(OutputInterface $output, $projectData, $project)
    {
        if (!empty($project)) {
            $output->writeln("Saving changed for project {$project->getFullname()} from bitbucket...");
            $project->setName($projectData['name']);
            $project->setDescription($projectData['description']);
            $project->setWebsite($projectData['website']);
            $project->setLanguage($projectData['language']);
            $project->setIsPrivate($projectData['is_private']);
            $project->setIsArchived(false);
            $updatedOn = \DateTime::createFromFormat(self::$bitbucketDateFormat, $projectData['updated_on']);
            $project->setUpdatedOn($updatedOn);
        }
    }

    private function updateGithubProjects(OutputInterface $output, $entityManager, $projects)
    {
        $responses = [];
        $responses[] = $this->githubClient->getRepositoriesResponse();

        $output->writeln('Getting projects from github...');
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
                    foreach ($response->toArray() as $projectData) {
                        $project = $this->createGithubProject(
                            $output, $projectData, $entityManager, $projects
                        );
                        $project = $this->updateGithubProject(
                            $output, $projectData, $project
                        );
                    }
        
                    $output->writeln('Saving changed projects from github...');
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

    private function createGithubProject(OutputInterface $output, $projectData, $entityManager, $projects)
    {
        $fullname = $projectData['full_name'];
        if (!array_key_exists($fullname, $projects)) {
            $output->writeln("Create project {$fullname} from github...");
            $project = new Project();
            $project->setProvider('github');
            $project->setFullName($fullname);
            $createdOn = \DateTime::createFromFormat(self::$ghDateFormat, $projectData['created_at']);
            $project->setCreatedOn($createdOn);
            $repoLink = "https://www.github.com/{$fullname}";
            $project->setRepoLink($repoLink);
            $entityManager->persist($project);
            return $project;
        } else {
            return $projects[$fullname];
        }
    }

    private function updateGithubProject(OutputInterface $output, $projectData, $project)
    {
        if (!empty($project)) {
            $output->writeln("Saving changed for project {$project->getFullname()} from github...");
            $project->setName($projectData['name']);
            $project->setDescription($projectData['description']);
            $project->setWebsite($projectData['homepage']);
            $project->setLanguage($projectData['language']);
            $project->setIsPrivate($projectData['private']);
            $project->setIsArchived($projectData['archived']);
            $updatedOn = \DateTime::createFromFormat(self::$ghDateFormat, $projectData['updated_at']);
            $project->setUpdatedOn($updatedOn);
        }
    }
}
