<?php
namespace App\TwigExtensions;

use Twig\Extension\RuntimeExtensionInterface;

class RepositoryBadgesRuntime implements RuntimeExtensionInterface
{
    public function __construct()
    {
        // this simple example doesn't define any dependency, but in your own
        // extensions, you'll need to inject services using this constructor
    }

    public function badgeImage($service_name, $type, $repo, $style = [], $extra = '')
    {
        // shields.io services
        $services = [
            'bitbucket' => ['pr'],
            'github' => ['downloads', 'issues-pr', 'license', 'v/tag'],
        ];

        if (!isset($services[$service_name])) {
            throw new \Exception("Service ${service_name} is not availabe");
        } else if (!in_array($type, $services[$service_name])) {
            throw new \Exception("Badge for ${type} is not availabe for service ${service_name}");
        } else {
            $style_text = '';
            foreach ($style as $sitem => $svalue ) {
                $style_text .= "${sitem}=${svalue}&";
            }
            if (!empty($style_text)) {
                $style_text = '?' . substr($style_text, 0, -1);
            }
            if (!empty($extra)) {
                $extra = '/' . $extra;
            }
            return "https://img.shields.io/${service_name}/${type}/${repo}${extra}${style_text}";
        }
        
    }
}
