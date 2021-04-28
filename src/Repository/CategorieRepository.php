<?php

namespace App\Repository;

use App\Entity\Classe;
use App\Entity\Categorie;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManager;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Categorie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Categorie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Categorie[]    findAll()
 * @method Categorie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Categorie::class);
    }


    public function findByClasse(): array
    {

        $entityManager = $this->getEntityManager();
        $query =  $entityManager->createQuery(
            'SELECT ca.categorie, ca.id, cl.nom 
            FROM App\Entity\categorie ca
            INNER JOIN App\Entity\classe cl
            WHERE ca.classe = cl.id 
            ORDER BY cl.nom, ca.categorie'
        );
         return $query->getResult();
    }


    /*
    public function findOneBySomeField($value): ?Categorie
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
