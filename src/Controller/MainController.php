<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\News;

class MainController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"})
     */
    public function home()
    {
        $news = $this->getDoctrine()
            ->getRepository(News::class)
            ->findAll(10);

        return $this->render('main/home.html.twig', [
            'news' => $news,
        ]);
    }
}
