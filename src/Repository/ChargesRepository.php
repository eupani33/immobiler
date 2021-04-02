<?php

namespace App\Repository;

use App\Entity\Charges;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Charges|null find($id, $lockMode = null, $lockVersion = null)
 * @method Charges|null findOneBy(array $criteria, array $orderBy = null)
 * @method Charges[]    findAll()
 * @method Charges[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChargesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Charges::class);
    }

    // /**
    //  * @return Charges[] Returns an array of Charges objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Charges
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
