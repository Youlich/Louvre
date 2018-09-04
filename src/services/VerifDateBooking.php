<?php
namespace App\services;


class VerifDateBooking {

	private $holidays;

	public function __construct($holidays)
	{
		$this->holidays = $holidays;
	}

	public function ValidDate($dateBooking) {

		//pour Commande impossible le mardi et le dimanche
		$dayOffBooking = array( 0, 2 );
		if ( $dateBooking->format( 'w' ) == $dayOffBooking ) {
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