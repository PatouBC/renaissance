<?php

namespace App\Repository;

use App\Entity\DayPartType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DayPartType|null find($id, $lockMode = null, $lockVersion = null)
 * @method DayPartType|null findOneBy(array $criteria, array $orderBy = null)
 * @method DayPartType[]    findAll()
 * @method DayPartType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DayPartTypeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DayPartType::class);
    }

    // /**
    //  * @return DayPartType[] Returns an array of DayPartType objects
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
    public function findOneBySomeField($value): ?DayPartType
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
