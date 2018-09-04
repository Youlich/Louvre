<?php

namespace App\Repository;

use App\Entity\Booking;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Booking|null find($id, $lockMode = null, $lockVersion = null)
 * @method Booking|null findOneBy(array $criteria, array $orderBy = null)
 * @method Booking[]    findAll()
 * @method Booking[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookingRepository extends ServiceEntityRepository {

	public function __construct( RegistryInterface $registry ) {
		parent::__construct( $registry, Booking::class );
	}

//nombre de tickets pris à la date de visite
	public function getNbTicketDate(\Datetime $dateVisit)
	{
		return $this->createQueryBuilder('b')
		            ->andWhere('b.dateVisit = :dateVisit')
		            ->setParameter('dateVisit', $dateVisit)
		            ->select('SUM(b.nbTicket) as nbTicket')
		            ->getQuery()
		            ->getSingleScalarResult();
	}

}