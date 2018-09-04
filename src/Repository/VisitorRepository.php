<?php

namespace App\Repository;

use App\Entity\Visitor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Visitor|null find($id, $lockMode = null, $lockVersion = null)
 * @method Visitor|null findOneBy(array $criteria, array $orderBy = null)
 * @method Visitor[]    findAll()
 * @method Visitor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VisitorRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Visitor::class);
    }

	public function getVisitorsByBooking($id)
	{
		return $this->createQueryBuilder('v')
		            ->innerJoin('v.booking', 'vbook')
		            ->addSelect('vbook')
		            ->andWhere('vbook = :id')
		            ->setParameter('booking_id', $id)
		            ->select('name')
		            ->getQuery()
		            ->getSingleScalarResult();
	}
}
