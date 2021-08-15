<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Service\LayoutService;

class ToolboxController extends AbstractController
{
    /**
     * @Route("/toolbox", methods={"GET"})
     */
    public function list(
        LayoutService $layout)
    {
        $layout->breadcrumbs[] = [
            'label' => 'Toolbox',
            'route' => 'app_toolbox_list'
        ];

        $tools = [];
        $i = 0;
        $tools[] = ['id' => $i++, 'name' => 'Resistance', 'route' => 'app_toolbox_resistance', 'description' => 'Resistance label decoder'];

        return $this->render('toolbox/list.html.twig', ['tools' => $tools]);
    }

    /**
     * @Route("/toolbox/resistance", methods={"GET"})
     */
    public function resistance(
        LayoutService $layout)
    {
        $layout->breadcrumbs[] = [
            'label' => 'Toolbox',
            'route' => 'app_toolbox_list'
        ];
        $layout->breadcrumbs[] = [
            'label' => 'Resistance',
            'route' => 'app_toolbox_resistance'
        ];

        return $this->render('toolbox/resistance.html.twig');
    }
}
