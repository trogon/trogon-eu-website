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
        $tools[] = ['id' => $i++, 'name' => 'Physics calculator', 'route' => 'app_toolbox_physicscalculator', 'description' => 'Converts the unit mesurments'];
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

        return $this->render('toolbox/show-tool.html.twig',[
            'alias' => 'hash-tool',
            'name' => 'Hash decoder',
            'description' => 'Encodes/decodes hash value',
        ]);
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

        return $this->render('toolbox/show-tool.html.twig',[
            'alias' => 'ip-address-tool',
            'name' => 'IP network calculator',
            'description' => 'Computes IP address, newtwork, mask',
        ]);
    }

    /**
     * @Route("/toolbox/physics-calculator", methods={"GET"})
     */
    public function physicsCalculator(
        LayoutService $layout)
    {
        $layout->breadcrumbs[] = [
            'label' => 'Toolbox',
            'route' => 'app_toolbox_list'
        ];
        $layout->breadcrumbs[] = [
            'label' => 'Resistance',
            'route' => 'app_toolbox_physicscalculator'
        ];

        return $this->render('toolbox/show-tool.html.twig',[
            'alias' => 'physics-calculator-tool',
            'name' => 'Physics calculator',
            'description' => 'Converts the unit mesurments',
        ]);
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

        return $this->render('toolbox/show-tool.html.twig',[
            'alias' => 'resistance-tool',
            'name' => 'Resistance',
            'description' => 'Decodes resistor label into resistance value',
        ]);
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
            'label' => 'Resolution',
            'route' => 'app_toolbox_resolution'
        ];

        return $this->render('toolbox/show-tool.html.twig',[
            'alias' => 'resolution-tool',
            'name' => 'Resolution calculator',
            'description' => 'Computes resolutions, density and screen size',
        ]);
    }
}
