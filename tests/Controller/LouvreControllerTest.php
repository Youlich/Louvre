<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class LouvreControllerTest extends WebTestCase
{
	/**
	 * @dataProvider urlProvider
	 */
	public function testPageIsSuccessful($url)
	{
		$client = self::createClient();
		$client->request('GET', $url);

		$this->assertTrue($client->getResponse()->isSuccessful());
	}

	public function urlProvider()
	{
		yield ['/'];
	}


	public function testHomepageTitle()
	{
		$client = static::createClient();
		$crawler = $client->request('GET', '/');
		$this->assertSame(3, $crawler->filter('h2')->count());
	}

}
