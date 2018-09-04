<?php

namespace App\services;


class PricesCalculations {

	private $prices;

	public function __construct($prices)
	{
		$this->prices = $prices;
	}
	public function getPriceTicket($visitor, $booking) {

        if ($visitor->getReduction() == 1) {
	        $price = $this->prices['reduced'];
        } else  {
	            if ($visitor->getAge() < 4 ) {
		            $price = $this->prices['baby'];
		            } elseif ($visitor->getAge() > 4 && $visitor->getAge() <= 12){
		            $price = $this->prices['child'];
		            } elseif ($visitor->getAge() > 12 ) {
		            $price = $this->prices['normal'];
		            } elseif ($visitor->getAge() > 60) {
		            $price = $this->prices['senior'];
		            }
        }

        if ($booking->getTypeVisit()->getType() == "Demi-journée") {

	            $price = $price/2;
	        }

        return $price;
    }


}