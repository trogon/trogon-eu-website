<?php
namespace App\TwigExtensions;

use Twig\Environment;
use Twig\Extension\RuntimeExtensionInterface;

class NavigationRuntime implements RuntimeExtensionInterface
{
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function navigation($name)
    {
        return $this->twig->render('layout/navigation.html.twig');
    }
}
