<?php

namespace App\Repository;

use App\Entity\Ecriture;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\DoctrineExtensions;

/**
 * @method Ecriture|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ecriture|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ecriture[]    findAll()
 * @method Ecriture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */


class EcritureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ecriture::class);
    }

    public function findActif()
    {
        return $this->createQueryBuilder('c')
            ->orderBy('c.date', 'DESC')
            ->getQuery()
            ->getResult();
    }


    public function FindMois($date)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.date LIKE :date')
            ->setParameter('date', $date)
            ->orderBy('c.date', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function Findstat($date)
    {
        return $this->createQueryBuilder('c')
            ->select('c.montant AS Ca')
            ->addSelect('c.date AS mois')
            ->where('c.categorie BETWEEN  1 AND 4')
            ->andWhere('c.date LIKE :date')
            ->setParameter('date', $date)
            ->orderBy('c.date', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
