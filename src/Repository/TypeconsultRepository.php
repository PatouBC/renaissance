<?php

namespace App\Repository;

use App\Entity\Typeconsult;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Typeconsult|null find($id, $lockMode = null, $lockVersion = null)
 * @method Typeconsult|null findOneBy(array $criteria, array $orderBy = null)
 * @method Typeconsult[]    findAll()
 * @method Typeconsult[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeconsultRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Typeconsult::class);
    }

    // /**
    //  * @return Typeconsult[] Returns an array of Typeconsult objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Typeconsult
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
