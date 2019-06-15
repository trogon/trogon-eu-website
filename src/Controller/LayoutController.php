<?php
namespace App\Controller;

use Psr\Log\LoggerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\RequestStack;

class LayoutController extends AbstractController
{
    public function navigation($name, RequestStack $requests, LoggerInterface $logger)
    {
        return $this->render('layout/navigation.html.twig', [
            'currentRoute' => $requests->getMasterRequest()->attributes->get('_route')
        ]);
    }

    public function breadcrumb(LoggerInterface $logger)
    {
        return $this->render('layout/breadcrumb.html.twig');
    }
}
