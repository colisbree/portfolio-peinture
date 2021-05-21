<?php

namespace App\Repository;

use App\Entity\Peinture;
use App\Entity\Categorie;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Peinture|null find($id, $lockMode = null, $lockVersion = null)
 * @method Peinture|null findOneBy(array $criteria, array $orderBy = null)
 * @method Peinture[]    findAll()
 * @method Peinture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PeintureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Peinture::class);
    }

    /**
     * retourne les 3 dernières peintures
     *
     * @return peinture[] Return an array of Peinture objects
     */
    public function lasTree()
    {
        return $this -> createQueryBuilder('p')  // p = alias de la table peinture
                -> orderBy('p.id', 'DESC')
                -> setMaxResults(3)
                -> getQuery()
                -> getResult()
        ;
    }
    
    /**
    * @return Peinture[] Returns an array of Peinture objects
    */
    public function findAllPortfolio(Categorie $categorie): array
    {
        return $this->createQueryBuilder('p')
            ->where(':categorie MEMBER OF p.categorie')
            ->andWhere('p.portfolio = TRUE')
            ->setParameter('categorie', $categorie)
            ->getQuery()
            ->getResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?Peinture
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
