<?php
namespace App\services;

use App\Entity\Booking;
use Doctrine\ORM\EntityManagerInterface;

class VerifStock  {

	private $stockticket;
	private $em;

	public function __construct($stockticket, EntityManagerInterface $em)
    {
	$this->stockticket = $stockticket;
	$this->em = $em;
    }


//Impossible de commander si le nb de billets pour le jour même est >1000
	public function ValidStock($dateVisit){

		$nbtotalTickets = $this->em->getRepository(Booking::class)->getNbTicketDate($dateVisit);
		if ($nbtotalTickets >= $this->stockticket){
			return false;
		} else {
			return true;
		}
	}

}
