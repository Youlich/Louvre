<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\TypeVisit;
use Doctrine\Common\Persistence\ObjectManager;

class LoadTypeVisit extends Fixture

{
	// Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
	public function load(ObjectManager $manager)
	{
			$typeVisitJ = new TypeVisit();
			$typeVisitJ->setType('Journée');
			$typeVisitDJ = new TypeVisit();
			$typeVisitDJ->setType('Demi-journée');

			// On les persiste
			$manager->persist($typeVisitJ);
		    $manager->persist($typeVisitDJ);

		// On déclenche l'enregistrement des types de visite
		$manager->flush();
	}
	}