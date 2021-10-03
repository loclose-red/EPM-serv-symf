<?php

namespace App\Repository;

use App\Entity\PtMesure;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PtMesure|null find($id, $lockMode = null, $lockVersion = null)
 * @method PtMesure|null findOneBy(array $criteria, array $orderBy = null)
 * @method PtMesure[]    findAll()
 * @method PtMesure[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PtMesureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PtMesure::class);
    }


    // /**
    //  * @return PtMesure[] Returns an array of PtMesure objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PtMesure
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
