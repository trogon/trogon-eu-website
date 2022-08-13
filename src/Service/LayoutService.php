<?php
namespace App\Service;

use Psr\Log\LoggerInterface;

class LayoutService
{
    public $breadcrumbs = [];
    public $mainMenu = [];
    public $socialLinks = [];

    public function __construct(LoggerInterface $logger)
    {
        $this->breadcrumbs[] = [
            'label' => 'Home',
            'route' => 'app_main_home'
        ];

        $this->mainMenu[] = [
            'label' => 'Home',
            'route' => 'app_main_home'
        ];
        $this->mainMenu[] = [
            'label' => 'Projects',
            'route' => 'app_project_list'
        ];
        $this->mainMenu[] = [
            'label' => 'Toolbox',
            'route' => 'app_toolbox_list'
        ];

        $this->socialLinks[] = [
            'label' => 'Linkedin',
            'icon' => 'fab fa-linkedin',
            'iconStyle' => 'color:rgb(0, 115, 177)',
            'route' => 'https://www.linkedin.com/in/mklemarczyk/'
        ];
        $this->socialLinks[] = [
            'label' => 'Bitbucket',
            'icon' => 'fab fa-bitbucket',
            'iconStyle' => 'color:rgb(38, 132, 255)',
            'route' => 'https://www.bitbucket.org/trogon-studios/'
        ];
        $this->socialLinks[] = [
            'label' => 'GitHub',
            'icon' => 'fab fa-github',
            'route' => 'https://www.github.com/trogon/'
        ];
        $this->socialLinks[] = [
            'label' => 'Hackster',
            'route' => 'https://www.hackster.io/trogon/'
        ];
        $this->socialLinks[] = [
            'label' => 'Adobe Portfolio',
            'icon' => 'fas fa-photo-video',
            'iconStyle' => 'color:rgb(190, 75, 219)',
            'route' => 'https://art.trogon.eu/'
        ];
        $this->socialLinks[] = [
            'label' => 'Twitter',
            'icon' => 'fab fa-twitter',
            'iconStyle' => 'color:rgb(29, 161, 242)',
            'route' => 'https://www.twitter.com/maciekpak/'
        ];
        $this->socialLinks[] = [
            'label' => 'Youtube channel',
            'icon' => 'fab fa-youtube',
            'iconStyle' => 'color:rgb(255, 0, 0)',
            'route' => 'https://www.youtube.com/channel/UCcnwMFLxso4AGmHSU_ftnqQ/'
        ];
    }
}
