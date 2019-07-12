<?php
namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpClient\Exception\ClientException;
use Symfony\Component\HttpClient\Exception\TransportException;

use App\Entity\Project;

/**
 * @Route("/cron", methods={"GET"})
 */
class CronController extends AbstractController
{
    /**
     * @Route("/update-projects", methods={"GET"})
     */
    public function updateProjects(
        LoggerInterface $logger,
        HttpClientInterface $bitbucketApiClient,
        HttpClientInterface $githubApiClient,
        HttpClientInterface $bitbucketOauthClient,
        HttpClientInterface $githubOauthClient)
    {
        $projects = $this->getDoctrine()
            ->getRepository(Project::class)
            ->findAllIndexedByFullName();
        
        $entityManager = $this->getDoctrine()
            ->getManager();

        try {
            $response = $bitbucketOauthClient->request('POST', 'access_token', [
                'body' => ['grant_type' => 'client_credentials']
            ]);

            $authResponse = $response->toArray();

            $bitbucketLink = '/2.0/repositories/trogon-studios?pagelen=25&fields=-*.links,-*.owner,-*.project,-*.mainbranch';
            $bitbucketDateFormat = 'Y-m-d\TH:i:s.uP';
            while (!empty($bitbucketLink)) {
                $bbRepos = $bitbucketApiClient->request('GET', $bitbucketLink, [
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
                $entityManager->flush();
            }
        } catch (ClientException $ex) { $logger->warning($ex); }
        catch (TransportException $ex) { $logger->warning($ex); }
        
        try {
            $githubLink = '/users/trogon/repos';
            $ghRepos = $githubApiClient->request('GET', $githubLink);
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
        } catch (ClientException $ex) { $logger->warning($ex); }
        catch (TransportException $ex) { $logger->warning($ex); }
        $entityManager->flush();

        return $this->render('cron/update_projects.html.twig', [
            'projects' => $projects
        ]);
    }
}
