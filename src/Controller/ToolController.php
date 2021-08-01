<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Service\LayoutService;

class ToolController extends AbstractController
{
    /**
     * @Route("/tools", methods={"GET"})
     */
    public function list(
        LayoutService $layout)
    {
        $layout->breadcrumbs[] = [
            'label' => 'Tools',
            'route' => 'app_tool_list'
        ];

        return $this->render('tool/list.html.twig');
    }
}
