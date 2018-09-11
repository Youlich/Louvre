<?php
namespace App\services;
class VerifDateVisit {

	private $holidays;
	private $closingdays;


	public function __construct($holidays, $closingdays)
	{
		$this->holidays = $holidays;
		$this->closingdays  = $closingdays;

	}
// pour Visite impossible le mardi et le dimanche
	public function ValidDate($dateVisit) {
		if (in_array($dateVisit->format( 'w' ),  $this->closingdays) ) {
			return false;
		}
//pour Visite impossible les jours fériés
		if ( in_array( $dateVisit->format( 'dd/MM' ), $this->holidays ) ) {
			return false;
		}

		else {
			return true;
		}
	}
}