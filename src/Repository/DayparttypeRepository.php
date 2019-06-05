<?php

namespace App\Repository;

use App\Entity\Dayparttype;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Dayparttype|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dayparttype|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dayparttype[]    findAll()
 * @method Dayparttype[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DayparttypeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Dayparttype::class);
    }

    // /**
    //  * @return Dayparttype[] Returns an array of Dayparttype objects
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
    public function findOneBySomeField($value): ?Dayparttype
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
