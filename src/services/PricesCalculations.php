<?php

namespace App\services;


class PricesCalculations {

	private $prices;

	public function __construct($prices)
	{
		$this->prices = $prices;
	}
	public function getPriceTicket($visitor, $booking) {


	            if ($visitor->getAge() < 4 ) {
		            $price = $this->prices['baby'];
		            } elseif ($visitor->getAge() > 4 && $visitor->getAge() <= 12){
		            $price = $this->prices['child'];
		            } elseif ($visitor->getAge() > 12 ) {
		            $price = $this->prices['normal'];
			            if ($visitor->getReduction() == 1) {
				            $price = $this->prices['reduced'];
			            }
		            } elseif ($visitor->getAge() > 60) {
		            $price = $this->prices['senior'];
			            if ($visitor->getReduction() == 1) {
				            $price = $this->prices['reduced'];
		            }
        }

        if ($booking->getTypeVisit()->getType() == "Demi-journée") {

	            $price = $price/2;
	        }

        return $price;
    }


}