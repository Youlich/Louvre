<?php

namespace App\Repository;

use App\Entity\TypeVisit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TypeVisit|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeVisit|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeVisit[]    findAll()
 * @method TypeVisit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeVisitRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TypeVisit::class);
    }

}
