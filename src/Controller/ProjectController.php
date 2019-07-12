<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Service\LayoutService;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpClient\Exception\ClientException;
use Symfony\Component\HttpClient\Exception\TransportException;

use App\Entity\Project;

class ProjectController extends AbstractController
{
    /**
     * @Route("/projects", methods={"GET"})
     */
    public function list(
        LayoutService $layout)
    {
        $layout->breadcrumbs[] = [
            'label' => 'Projects',
            'route' => 'app_project_list'
        ];

        $showPrivate = false;
        $projects = $this->getDoctrine()
            ->getRepository(Project::class)
            ->findBy(['is_private' => $showPrivate]);

        usort($projects, function ($a, $b) {
            return strcasecmp($a->getName(), $b->getName());
        });

        return $this->render('project/list.html.twig', [
            'projects' => $projects,
        ]);
    }
}
