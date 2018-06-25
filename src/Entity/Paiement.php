<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="paiement")
 * @ORM\Entity(repositoryClass="App\Repository\PaiementRepository")
 */
class Paiement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $transactionValide;

	/**
	 * @ORM\OneToOne(targetEntity="App\Entity\Reservation", cascade={"persist"})
	 */
    private $reservation;

    public function getId()
    {
        return $this->id;
    }

    public function getTransactionValide(): ?bool
    {
        return $this->transactionValide;
    }

    public function setTransactionValide(bool $transactionValide): self
    {
        $this->transactionValide = $transactionValide;

        return $this;
    }

	/**
	 * @return mixed
	 */
	public function getReservation() {
		return $this->reservation;
	}

	/**
	 * @param mixed $reservation
	 */
	public function setReservation( $reservation ): void {
		$this->reservation = $reservation;
	}


}
