<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Table(name="visitor")
 * @ORM\Entity(repositoryClass="App\Repository\VisitorRepository")
 */
class Visitor
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="datetime")
     */
    private $birthDate;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
    private $country;

	/**
	 * @ORM\ManyToOne(targetEntity=Booking::class, inversedBy="visitors", cascade="persist")
	 * @ORM\JoinColumn(nullable=false)
	 */
	private $booking;

	/**
	 * @ORM\Column(type="boolean")
	 */
	private $reduction;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $price;


	public function __construct(Booking $booking = null)
	{
		$this->booking = $booking;
		$this->setReduction(0);
		$this->setPrice('0');

	}

    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

	/**
	 * @return mixed
	 */
	public function getCountry() {
		return $this->country;
	}

	/**
	 * @param mixed $country
	 */
	public function setCountry( $country ): void {
		$this->country = $country;
	}

	/**
	 * @return mixed
	 */
	public function getBooking() {
		return $this->booking;
	}

	/**
	 * @param mixed $command
	 */
	public function setBooking( $booking ): void {
		$this->booking = $booking;
	}

	/**
	 * @return mixed
	 */
	public function getReduction() {
		return $this->reduction;
	}

	/**
	 * @param mixed $reduction
	 */
	public function setReduction( $reduction ): void {
		$this->reduction = $reduction;
	}

	/**
	 * @return mixed
	 */
	public function getPrice() {
		return $this->price;
	}

	/**
	 * @param mixed $price
	 */
	public function setPrice( $price ): void {
		$this->price = $price;
	}

	public function getAge() {
		$birthDate = $this->getBirthDate();
		$now = new \datetime('now');
		$age = $birthDate->diff($now, true)->y;
		return $age;
	}

}
