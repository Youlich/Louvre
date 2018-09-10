<?php

namespace App\services;

class VerifDateBooking {

	private $holidays;
	private $closingbookingdays;

	public function __construct($holidays, $closingbookingdays)
	{
		$this->holidays = $holidays;
		$this->closingbookingdays = $closingbookingdays;
	}
	public function ValidDate($dateBooking) {
		//pour Commande impossible le mardi et le dimanche

		if ( in_array($dateBooking->format( 'w' ), $this->closingbookingdays )) {
			return false;
		}
		//pour commande impossible les jours fériés
		if ( in_array( $dateBooking->format( 'dd/MM' ), $this->holidays ) ) {
			return false;
		}
		else {
			return true;
		}
	}
}