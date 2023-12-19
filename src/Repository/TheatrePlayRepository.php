<?php

namespace App\Repository;

use App\Entity\TheatrePlay;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TheatrePlay>
 *
 * @method TheatrePlay|null find($id, $lockMode = null, $lockVersion = null)
 * @method TheatrePlay|null findOneBy(array $criteria, array $orderBy = null)
 * @method TheatrePlay[]    findAll()
 * @method TheatrePlay[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TheatrePlayRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TheatrePlay::class);
    }

//    /**
//     * @return TheatrePlay[] Returns an array of TheatrePlay objects
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

//    public function findOneBySomeField($value): ?TheatrePlay
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
