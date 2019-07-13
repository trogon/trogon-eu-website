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

use App\Entity\Project;

class UpdateProjectsCommand extends Command
{
    protected static $defaultName = 'app:cron:update-projects';

    private $logger;
    private $bitbucketApiClient;
    private $githubApiClient;
    private $bitbucketOauthClient;
    private $githubOauthClient;
    private $doctrine;

    public function __construct(
        LoggerInterface $logger,
        RegistryInterface $doctrine,
        HttpClientInterface $bitbucketApiClient,
        HttpClientInterface $githubApiClient,
        HttpClientInterface $bitbucketOauthClient,
        HttpClientInterface $githubOauthClient)
    {
        $this->logger = $logger;
        $this->doctrine = $doctrine;
        $this->bitbucketApiClient = $bitbucketApiClient;
        $this->githubApiClient = $githubApiClient;
        $this->bitbucketOauthClient = $bitbucketOauthClient;
        $this->githubOauthClient = $githubOauthClient;


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

        try {
            $output->writeln('Requesting authentication for bitbucket...');
            $response = $this->bitbucketOauthClient->request('POST', 'access_token', [
                'body' => ['grant_type' => 'client_credentials']
            ]);

            $authResponse = $response->toArray();

            $bitbucketLink = '/2.0/repositories/trogon-studios?pagelen=25&fields=-*.links,-*.owner,-*.project,-*.mainbranch';
            $bitbucketDateFormat = 'Y-m-d\TH:i:s.uP';
            while (!empty($bitbucketLink)) {
                $output->writeln('Getting projects from bitbucket...');
                $bbRepos = $this->bitbucketApiClient->request('GET', $bitbucketLink, [
                    'auth_bearer' => $authResponse['access_token']
                ]);
                $responseArray = $bbRepos->toArray();
                foreach ($responseArray['values'] as $projectData) {
                    $fullname = $projectData['full_name'];
                    if (!array_key_exists($fullname, $projects)) {
                        $project = new Project();
                        $project->setProvider('bitbucket');
                        $project->setName($projectData['name']);
                        $project->setFullName($fullname);
                        $project->setDescription($projectData['description']);
                        $project->setWebsite($projectData['website']);
                        $project->setLanguage($projectData['language']);
                        $project->setIsPrivate($projectData['is_private']);
                        $project->setIsArchived(false);
                        $createdOn = \DateTime::createFromFormat($bitbucketDateFormat, $projectData['created_on']);
                        $project->setCreatedOn($createdOn);
                        $updatedOn = \DateTime::createFromFormat($bitbucketDateFormat, $projectData['updated_on']);
                        $project->setUpdatedOn($updatedOn);
                        $repoLink = "https://www.bitbucket.com/{$fullname}";
                        $project->setRepoLink($repoLink);
                        $entityManager->persist($project);
                    }
                }
                $bitbucketLink = isset($responseArray['next']) ? $responseArray['next'] : null;
                $output->writeln('Saving changed projects from bitbucket...');
                $entityManager->flush();
            }
        } catch (ClientException $ex) { $this->logger->warning($ex); }
        catch (TransportException $ex) { $this->logger->warning($ex); }
        
        try {
            $githubLink = '/users/trogon/repos';
            $output->writeln('Getting projects from github...');
            $ghRepos = $this->githubApiClient->request('GET', $githubLink);
            $ghDateFormat = 'Y-m-d\TH:i:s\Z';
            foreach ($ghRepos->toArray() as $projectData) {
                $fullname = $projectData['full_name'];
                if (!array_key_exists($fullname, $projects)) {
                    $project = new Project();
                    $project->setProvider('github');
                    $project->setName($projectData['name']);
                    $project->setFullName($fullname);
                    $project->setDescription($projectData['description']);
                    $project->setWebsite($projectData['homepage']);
                    $project->setLanguage($projectData['language']);
                    $project->setIsPrivate($projectData['private']);
                    $project->setIsArchived($projectData['archived']);
                    $createdOn = \DateTime::createFromFormat($ghDateFormat, $projectData['created_at']);
                    $project->setCreatedOn($createdOn);
                    $updatedOn = \DateTime::createFromFormat($ghDateFormat, $projectData['updated_at']);
                    $project->setUpdatedOn($updatedOn);
                    $repoLink = "https://www.github.com/{$fullname}";
                    $project->setRepoLink($repoLink);
                    $entityManager->persist($project);
                }
            }
            $output->writeln('Saving changed projects from github...');
            $entityManager->flush();
        } catch (ClientException $ex) { $this->logger->warning($ex); }
        catch (TransportException $ex) { $this->logger->warning($ex); }

        $output->writeln('Process finished.');
    }
}
