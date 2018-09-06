<?php
namespace App\services;


class VerifDateVisitHour {


//pour dateVisite jour même et >= 14h pas de billet journée
	public function ValidDateHour($dateVisit, $booking) {

	$typeVisit = $booking->getTypeVisit();
	$dateBooking = $booking->getDateBooking();
	$now       = new \DateTime( 'now' );
	if ( ( $typeVisit == '2' ) && ( $dateVisit->format( 'dd/MM/yyyy') === $now->format( 'dd/MM/yyyy' ) ) && ( $dateBooking->format( 'H' ) >= '14' ) ) {
		return false;
	}

else {
		return true;
	}
}
}


