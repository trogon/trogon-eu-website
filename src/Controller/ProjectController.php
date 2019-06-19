<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Service\LayoutService;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpClient\Exception\ClientException;

class ProjectController extends AbstractController
{
    /**
     * @Route("/projects", methods={"GET"})
     */
    public function list(
        LayoutService $layout,
        HttpClientInterface $githubApiClient,
        HttpClientInterface $bitbucketApiClient)
    {
        $layout->breadcrumbs[] = [
            'label' => 'Projects',
            'route' => 'app_project_list'
        ];

        $repos = [];

        try {
            $bbRepos = $bitbucketApiClient->request('GET', '/2.0/repositories/trogon-studios');
            foreach ($bbRepos->toArray()['values'] as $project) {
                $repos[] = [
                    'name' => $project['name'],
                    'url' => "https://www.bitbucket.com/{$project['full_name']}",
                    'description' => $project['description']
                ];
            }
        } catch (ClientException $ex) { }

        try {
            $ghRepos = $githubApiClient->request('GET', '/users/trogon/repos');
            foreach ($ghRepos->toArray() as $project) {
                $repos[] = [
                    'name' => $project['name'],
                    'url' => "https://www.github.com/{$project['full_name']}",
                    'description' => $project['description']
                ];
            }
        } catch (ClientException $ex) { }

        usort($repos, function ($a, $b) {
            return strcmp($a['name'], $b['name']);
        });

        return $this->render('project/list.html.twig', [
            'repos' => $repos,
        ]);
    }
}
