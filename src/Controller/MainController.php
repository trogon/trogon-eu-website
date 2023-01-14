<?php

namespace App\Controller;

use Doctrine\Common\Collections\Criteria;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\NewsRepository;

class MainController extends AbstractController
{
    #[Route("/", methods: ["GET"])]
    public function home(
        NewsRepository $newsDb
    ) {
        $itemPerPage = 9;

        $criteria = Criteria::create()
            ->setMaxResults($itemPerPage);

        $news = $newsDb
            ->findAllOrderedByCreatedOn($criteria);

        return $this->render('main/home.html.twig', [
            'itemsPerPage' => $itemPerPage,
            'news' => $news,
        ]);
    }
}
