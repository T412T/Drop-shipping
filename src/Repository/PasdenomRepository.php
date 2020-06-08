<?php

namespace App\Repository;

use App\Entity\Pasdenom;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Pasdenom|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pasdenom|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pasdenom[]    findAll()
 * @method Pasdenom[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PasdenomRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pasdenom::class);
    }

    // /**
    //  * @return Pasdenom[] Returns an array of Pasdenom objects
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
    public function findOneBySomeField($value): ?Pasdenom
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
