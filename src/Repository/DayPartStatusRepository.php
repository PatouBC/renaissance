<?php

namespace App\Repository;

use App\Entity\DayPartStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DayPartStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method DayPartStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method DayPartStatus[]    findAll()
 * @method DayPartStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DayPartStatusRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DayPartStatus::class);
    }

    // /**
    //  * @return DayPartStatus[] Returns an array of DayPartStatus objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DayPartStatus
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
