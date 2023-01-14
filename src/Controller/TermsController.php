<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Service\LayoutService;

use App\Entity\Project;

class TermsController extends AbstractController
{
    #[Route("/privacy", methods: ["GET"])]
    public function privacy(
        LayoutService $layout
    ) {
        $layout->breadcrumbs[] = [
            'label' => 'Privacy',
            'route' => 'app_terms_privacy'
        ];

        return $this->render('terms/privacy.html.twig');
    }
}
