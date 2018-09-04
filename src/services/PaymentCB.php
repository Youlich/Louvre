<?php

namespace App\services;

use Stripe\Stripe;

class PaymentCB {

	public function __construct($keystripe)
	{
		Stripe::setApiKey($keystripe);
	}

	public function launchingStripe($booking)
	{
		//\Stripe\Stripe::setApiKey('$this->keystripe');
		// Get the credit card details submitted by the form
		$token = $_POST['stripeToken'];
		// Create a charge: this will charge the user's card
		try {
			$charge = \Stripe\Charge::create(array(
				"amount" => $booking->getTotalAmount()*100, // Amount in cents
				"currency" => "eur",
				"source" => $token,
				"description" => "Payment PaymentCB - Musée du Louvre"
			));
			return true;

		} catch(\Stripe\Error\Card $e) {

			return false;

		}
	}
}