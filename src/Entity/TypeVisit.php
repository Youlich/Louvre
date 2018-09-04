<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Table(name="type_visit")
 * @ORM\Entity(repositoryClass="App\Repository\TypeVisitRepository")
 */
class TypeVisit
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
    private $type;

	/**
	 * @ORM\OneToMany(targetEntity=Booking::class, mappedBy="typeVisit", cascade={"persist","remove"})
	 */
	private $bookings;


    public function getId()
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

	/**
	 * @return mixed
	 */
	public function getBookings() {
		return $this->bookings;
	}

	/**
	 * @param mixed $reservations
	 */
	public function setBookings($bookings): void {
		$this->bookings = $bookings;
	}

	public function getTypeTranslationKey()
	{
		if ($this->getType() == 'Journée') {
			return 'typeVisit.type.day';
		}
		return 'typeVisit.type.halfday';
	}


}
