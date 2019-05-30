<?php

namespace App\Repository;

use App\Entity\Workingday;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Workingday|null find($id, $lockMode = null, $lockVersion = null)
 * @method Workingday|null findOneBy(array $criteria, array $orderBy = null)
 * @method Workingday[]    findAll()
 * @method Workingday[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WorkingdayRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Workingday::class);
    }

    // /**
    //  * @return Workingday[] Returns an array of Workingday objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Workingday
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
