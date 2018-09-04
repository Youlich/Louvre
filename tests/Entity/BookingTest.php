<?php

namespace App\Tests;

use App\Entity\Booking;
use PHPUnit\Framework\TestCase;

class BookingTest extends TestCase
{
    public function testGenerateBookingCode()
    {
	    $booking= new Booking();
	    $bookingCode = $booking->generateBookingCode(6);
        $this->assertRegExp('/^RESA[0-9]+$/', $bookingCode, $message = '$bookingCode');
    }
}
