<?php
namespace App\TwigExtensions;

use Twig\Environment;
use Twig\Extension\RuntimeExtensionInterface;

class BreadcrumbRuntime implements RuntimeExtensionInterface
{
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function breadcrumb()
    {
        return $this->twig->render('layout/breadcrumb.html.twig');
    }
}
