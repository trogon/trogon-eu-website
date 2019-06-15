<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"})
     */
    public function home()
    {
        return $this->render('main/home.html.twig');
    }
}
