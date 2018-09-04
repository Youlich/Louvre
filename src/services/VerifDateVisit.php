<?php
namespace App\services;


class VerifDateVisit {

	private $holidays;

	public function __construct($holidays)
	{
		$this->holidays = $holidays;
	}

// pour Visite impossible le mardi
public function ValidDate($dateVisit, $booking) {

	if ( $dateVisit->format( 'w' ) == '2' ) {
		return false;
	}

//pour Visite impossible les jours fériés

	if ( in_array( $dateVisit->format( 'dd/MM' ), $this->holidays ) ) {
		return false;
	}

//pour dateVisite jour même et >= 14h pas de billet journée

	$typeVisit = $booking->getTypeVisit();
	$dateBooking = $booking->getDateBooking();
	$now       = new \DateTime( 'now' );
	if ( ( $typeVisit == '2' ) && ( $dateVisit->format( 'dd/MM/yyyy') === $now->format( 'dd/MM/yyyy' ) ) && ( $dateBooking->format( 'H' ) >= '14' ) ) {
		return false;
	}


// vérification sur un jour déjà passé
	if ( $dateVisit->format( 'dd/MM/yyyy' ) < $now->format( 'dd/MM/yyyy' ) ) {
		return false;
	}

else {
		return true;
	}
}
}


