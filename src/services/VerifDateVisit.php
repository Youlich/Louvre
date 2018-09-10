<?php
namespace App\services;
class VerifDateVisit {

	private $holidays;


	public function __construct($holidays)
	{
		$this->holidays = $holidays;

	}
// pour Visite impossible le mardi
	public function ValidDate($dateVisit) {
		if ($dateVisit->format( 'w' ) == '2' ) {
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