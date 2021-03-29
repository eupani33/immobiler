<?php

namespace App\Repository;

use App\Entity\Loyer;
use App\Entity\Contrat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Loyer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Loyer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Loyer[]    findAll()
 * @method Loyer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LoyerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Loyer::class);
    }

    /**
      * @return array 
      */
     
    public function apiFindAll(): array 
    {   
        $qb = $this
            ->createQueryBuilder('l')
            ->orderBy('l.paiement','DESC');
        $query = $qb->getQuery();
        return $query->execute(); 
    } 


    // /**
    //  * @return Loyer[] Returns an array of Loyer objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Loyer
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
