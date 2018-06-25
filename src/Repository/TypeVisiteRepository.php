<?php

namespace App\Repository;

use App\Entity\TypeVisite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TypeVisite|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeVisite|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeVisite[]    findAll()
 * @method TypeVisite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeVisiteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TypeVisite::class);
    }

//    /**
//     * @return TypeVisite[] Returns an array of TypeVisite objects
//     */
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
    public function findOneBySomeField($value): ?TypeVisite
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
