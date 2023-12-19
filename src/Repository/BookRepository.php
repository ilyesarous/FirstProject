<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Book>
 *
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }
    
    public function getBooks()
    {
        return $this->createQueryBuilder('b')
        ->setMaxResults(3)
        ->getQuery()
        ->getResult();
    }
    
    public function searchBookByRef($value)
    {
        return $this->createQueryBuilder('b')
        ->where('b.title like :v')
        ->setParameter('v', $value)
        ->getQuery()
        ->getResult();
    }
    public function getNbBooks()
    {
        return $this->createQueryBuilder('b')
        ->select('count(b.title) as nbBooks')
        ->where('b.category = :c')
        ->setParameter('c', 'thriller')
        ->getQuery()
        ->getSingleScalarResult(); //khater ma aandich list
    }
    public function getNbBook() // khedma bl createQuerry fi 3ou4 createQuerryBuilder
    {
        $em = $this->getEntityManager();
        return $em->createQuery('select count(b) from App\Entity\Book b where b.category = :c')
        ->setParameter('c', 'Romance')

        ->getSingleScalarResult(); //khater ma aandich list
    }
    
    public function showBooksByAuthor()
    {
        return $this->createQueryBuilder('b')
        ->join('b.author', 'a')
        ->addSelect('a')
        // ->from('YourMappingSpace:Campsite', 's')
        ->orderBy('a.username', 'DESC')
        ->getQuery()
        ->getResult();
    }


//    /**
//     * @return Book[] Returns an array of Book objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Book
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
