<?php
namespace App\TwigExtensions;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('badge', [RepositoryBadgesRuntime::class, 'badgeImage']),
            new TwigFunction('breadcrumb', [BreadcrumbRuntime::class, 'breadcrumb'], ['is_safe' => ['html']]),
            new TwigFunction('navigation', [NavigationRuntime::class, 'navigation'], ['is_safe' => ['html']]),
        ];
    }
}
