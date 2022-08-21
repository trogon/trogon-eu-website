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
        $tools[] = ['id' => $i++, 'name' => 'Hash', 'route' => 'app_toolbox_hash', 'description' => 'Computes hash'];
        $tools[] = ['id' => $i++, 'name' => 'IP Address', 'route' => 'app_toolbox_ipaddress', 'description' => 'Computes IP address, mask and networks'];
        $tools[] = ['id' => $i++, 'name' => 'Resistance', 'route' => 'app_toolbox_resistance', 'description' => 'Resistance label decoder'];
        $tools[] = ['id' => $i++, 'name' => 'Resolution', 'route' => 'app_toolbox_resolution', 'description' => 'Computes resolution, screen size and pixel density'];

        return $this->render('toolbox/list.html.twig', ['tools' => $tools]);
    }

    /**
     * @Route("/toolbox/hash", methods={"GET"})
     */
    public function hash(
        LayoutService $layout)
    {
        $layout->breadcrumbs[] = [
            'label' => 'Toolbox',
            'route' => 'app_toolbox_list'
        ];
        $layout->breadcrumbs[] = [
            'label' => 'Hash',
            'route' => 'app_toolbox_hash'
        ];

        return $this->render('toolbox/hash.html.twig');
    }

    /**
     * @Route("/toolbox/ip-address", methods={"GET"})
     */
    public function ipAddress(
        LayoutService $layout)
    {
        $layout->breadcrumbs[] = [
            'label' => 'Toolbox',
            'route' => 'app_toolbox_list'
        ];
        $layout->breadcrumbs[] = [
            'label' => 'IP Address',
            'route' => 'app_toolbox_ipaddress'
        ];

        return $this->render('toolbox/ip-address.html.twig');
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

    /**
     * @Route("/toolbox/resolution", methods={"GET"})
     */
    public function resolution(
        LayoutService $layout)
    {
        $layout->breadcrumbs[] = [
            'label' => 'Toolbox',
            'route' => 'app_toolbox_list'
        ];
        $layout->breadcrumbs[] = [
            'label' => 'Resistance',
            'route' => 'app_toolbox_resolution'
        ];

        return $this->render('toolbox/resolution.html.twig');
    }
}
