<?php

namespace App\Tests;

use App\Entity\Visitor;
use PHPUnit\Framework\TestCase;

class VisitorTest extends TestCase {

	public function testGetAge() {

		$visitor = new Visitor;
		$visitor->setBirthDate(new \DateTime('1978-01-24 00:00:00'));
		$age = $visitor->getAge();
		$this->assertEquals(40, $age);
	}

	public function testNewVisitor() {
		$client = new Visitor();
		$client->setName('Dupont');
		$client->setFirstName('Thomas');
		$client->setReduction(1);
		$this->assertEquals('Dupont', $client->getName());
		$this->assertEquals('Thomas', $client->getFirstName());
		$this->assertEquals(1, $client->getReduction());
	}


}