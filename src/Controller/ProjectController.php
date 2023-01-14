<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Service\LayoutService;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpClient\Exception\ClientException;
use Symfony\Component\HttpClient\Exception\TransportException;

use App\Repository\ProjectRepository;

class ProjectController extends AbstractController
{
    private $showPrivate = false;

    #[Route("/projects", methods: ["GET"])]
    public function list(
        LayoutService $layout,
        ProjectRepository $projectDb
    ) {
        $layout->breadcrumbs[] = [
            'label' => 'Projects',
            'route' => 'app_project_list'
        ];

        $projects = $projectDb
            ->findBy(['is_private' => $this->showPrivate]);

        usort($projects, function ($a, $b) {
            return strcasecmp($a->getName(), $b->getName());
        });

        return $this->render('project/list.html.twig', [
            'projects' => $projects,
        ]);
    }

    #[Route("/project/{name}", methods: ["GET"])]
    public function show(
        string $name,
        LayoutService $layout,
        ProjectRepository $projectDb
    ) {
        // Replace the % decoded symbol to / separator. The name variable is already URL decoded.
        $full_name = str_replace('%', '/', $name);

        $projects = $projectDb
            ->findBy(['is_private' => $this->showPrivate, 'full_name' => $full_name]);

        usort($projects, function ($a, $b) {
            return strcasecmp($a->getName(), $b->getName());
        });

        if (count($projects) > 0) {
            $project = $projects[0];

            $layout->breadcrumbs[] = [
                'label' => 'Projects',
                'route' => 'app_project_list'
            ];
            $layout->breadcrumbs[] = [
                'label' => $project->getName(),
                'route' => 'app_project_show'
            ];

            return $this->render('project/show.html.twig', [
                'project' => $project,
            ]);
        } else {
            throw $this->createNotFoundException('The project does not exist');
        }
    }
}
