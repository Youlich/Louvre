<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="billet")
 * @ORM\Entity(repositoryClass="App\Repository\BilletRepository")
 */
class Billet
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", precision=4, scale=2)
     */
    private $tarif;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Visiteur", cascade={"persist"})
     */
    private $visiteur;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\TypeVisite")
	 * @ORM\JoinColumn(nullable=false)
	 */
	private $TypeVisite;

    public function getId()
    {
        return $this->id;
    }

    public function getTarif()
    {
        return $this->tarif;
    }

    public function setTarif($tarif): self
    {
        $this->tarif = $tarif;

        return $this;
    }

	/**
	 * @return mixed
	 */
	public function getVisiteur() {
		return $this->visiteur;
	}

	/**
	 * @param mixed $visiteur
	 */
	public function setVisiteur( $visiteur ): void {
		$this->visiteur = $visiteur;
	}

	/**
	 * @return mixed
	 */
	public function getTypeVisite() {
		return $this->TypeVisite;
	}

	/**
	 * @param mixed $TypeVisite
	 */
	public function setTypeVisite( $TypeVisite ): void {
		$this->TypeVisite = $TypeVisite;
	}




}
