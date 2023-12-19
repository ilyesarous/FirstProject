<?php

namespace App\Repository;

use App\Entity\TheaterPlay;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TheaterPlay>
 *
 * @method TheaterPlay|null find($id, $lockMode = null, $lockVersion = null)
 * @method TheaterPlay|null findOneBy(array $criteria, array $orderBy = null)
 * @method TheaterPlay[]    findAll()
 * @method TheaterPlay[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TheaterPlayRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TheaterPlay::class);
    }

//    /**
//     * @return TheaterPlay[] Returns an array of TheaterPlay objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TheaterPlay
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
