<?php
namespace App\Controller;

use Doctrine\Common\Collections\Criteria;

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
        $itemPerPage = 9;

        $criteria = Criteria::create()
            ->setMaxResults($itemPerPage);

        $news = $this->getDoctrine()
            ->getRepository(News::class)
            ->findAllOrderedByCreatedOn($criteria);

        return $this->render('main/home.html.twig', [
            'itemsPerPage' => $itemPerPage,
            'news' => $news,
        ]);
    }
}
