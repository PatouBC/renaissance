<?php

namespace App\Repository;

use App\Entity\Daypartstatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Daypartstatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method Daypartstatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method Daypartstatus[]    findAll()
 * @method Daypartstatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DaypartstatusRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Daypartstatus::class);
    }

    // /**
    //  * @return Daypartstatus[] Returns an array of Daypartstatus objects
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
    public function findOneBySomeField($value): ?Daypartstatus
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
