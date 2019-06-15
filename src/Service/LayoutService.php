<?php
namespace App\Service;

use Psr\Log\LoggerInterface;

class LayoutService
{
    public $breadcrumbs = [];
    public $mainMenu = [];

    public function __construct(LoggerInterface $logger)
    {
        $this->breadcrumbs[] = [
            'label' => 'Home',
            'route' => 'app_main_home'
        ];
    }
}
