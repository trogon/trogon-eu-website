<?php

namespace App\Repository;

use App\Entity\News;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method News|null find($id, $lockMode = null, $lockVersion = null)
 * @method News|null findOneBy(array $criteria, array $orderBy = null)
 * @method News[]    findAll()
 * @method News[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NewsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, News::class);
    }

    /**
     * @return News[] Returns an array of News objects, use reference as result array key
     */
    public function findAllIndexedByReference(Criteria $criteria = null)
    {
        return $this->createQueryBuilder('n', 'n.reference');

        if ($criteria != null) {
            $qb->addCriteria($criteria);
        }

        return $qb
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return News[] Returns an array of News objects, use ordered by time
     */
    public function findAllOrderedByCreatedOn(Criteria $criteria = null)
    {
        $qb = $this->createQueryBuilder('n')
            ->orderBy('n.created_on', 'DESC');

        if ($criteria != null) {
            $qb->addCriteria($criteria);
        }

        return $qb
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return News[] Returns an array of News objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?News
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
