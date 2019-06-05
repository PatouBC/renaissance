<?php

namespace App\Repository;

use App\Entity\DayPart;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DayPart|null find($id, $lockMode = null, $lockVersion = null)
 * @method DayPart|null findOneBy(array $criteria, array $orderBy = null)
 * @method DayPart[]    findAll()
 * @method DayPart[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DayPartRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DayPart::class);
    }

    // /**
    //  * @return DayPart[] Returns an array of DayPart objects
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
    public function findOneBySomeField($value): ?DayPart
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
