<?php

namespace App\Repository;

use App\Entity\Grandeur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Grandeur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Grandeur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Grandeur[]    findAll()
 * @method Grandeur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GrandeurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Grandeur::class);
    }

    // /**
    //  * @return Grandeur[] Returns an array of Grandeur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Grandeur
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
