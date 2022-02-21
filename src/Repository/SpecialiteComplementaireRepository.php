<?php

namespace App\Repository;

use App\Entity\SpecialiteComplementaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SpecialiteComplementaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method SpecialiteComplementaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method SpecialiteComplementaire[]    findAll()
 * @method SpecialiteComplementaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpecialiteComplementaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SpecialiteComplementaire::class);
    }

    // /**
    //  * @return SpecialiteComplementaire[] Returns an array of SpecialiteComplementaire objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SpecialiteComplementaire
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
