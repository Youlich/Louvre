<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraints\Holidays;
use App\Validator\Constraints\PassedDays;


/**
 * @ORM\Table(name="booking")
 * @ORM\Entity(repositoryClass="App\Repository\BookingRepository")
 */
class Booking {
	/**
	 * @ORM\Id()
	 * @ORM\GeneratedValue()
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $bookingCode;

	/**
	 * @ORM\Column(type="date")
	 * @Holidays(message="error.booking.close")
	 * @PassedDays(message="error.booking.passed")
	 */
	private $dateVisit;

	/**
	 * @ORM\Column(type="integer")
	 * @Assert\NotBlank(message="booking.blank.nbTicket")
	 */
	private $nbTicket;

	/**
	 * @ORM\Column(type="datetime")
	 */
	private $dateBooking;

	/**
	 * @ORM\Column(type="string", length=255)
	 * @Assert\NotBlank(message="mail.not_blank")
	 * @Assert\Email(message="mail.invalid")
	 */
	private $email;

	/**
	 * @ORM\OneToMany(targetEntity=Visitor::class, mappedBy="booking", cascade={"persist","remove"})
	 */
	private $visitors;

	/**
	 * @ORM\ManyToOne(targetEntity=TypeVisit::class, inversedBy="bookings", cascade="persist")
	 * @ORM\JoinColumn(nullable=true)
	 * @Assert\NotBlank(message="Merci de sélectionner votre type de visite souhaitée.")
	 */
	private $typeVisit;

	/**
	 * @ORM\Column(type="boolean")
	 */

	private $paymentvalid;

	public function __construct() {
		$this->dateBooking = new \Datetime();
		$this->visitors   = new ArrayCollection();
		$this->tickets     = new ArrayCollection();
        $this->setDateBooking(new \DateTime( 'now' ));
		$this->setDateVisit( new \DateTime( 'now' ));
		$bookingCode = $this->generateBookingCode(6);
		$this->setBookingCode($bookingCode);
		$this->setPaymentvalid(false);
	}

	public function getId() {
		return $this->id;
	}

	/**
	 * @return mixed
	 */
	public function getDateVisit() {
		return $this->dateVisit;
	}

	/**
	 * @param mixed $dateVisit
	 */
	public function setDateVisit( $dateVisit ): void {
		$this->dateVisit = $dateVisit;
	}

	/**
	 * @return mixed
	 */
	public function getNbTicket() {
		return $this->nbTicket;
	}

	/**
	 * @param mixed $nbTicket
	 */
	public function setNbTicket( $nbTicket ): void {
		$this->nbTicket = $nbTicket;
	}

	/**
	 * @return mixed
	 */
	public function getDateBooking() {
		return $this->dateBooking;
	}

	/**
	 * @param mixed $dateBooking
	 */
	public function setDateBooking( $dateBooking ): void {
		$this->dateBooking = $dateBooking;
	}

	/**
	 * @return mixed
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * @param mixed $email
	 */
	public function setEmail( $email ): void {
		$this->email = $email;
	}

	/**
	 * @ORM\PreUpdate
	 */
	public function updateDateBooking() {
		$this->setDateBooking( new \Datetime() );
	}

	/**
	 * @return mixed
	 */
	public function getVisitors() {
		return $this->visitors;
	}

	/**
	 * @param mixed $visitors
	 */
	public function setVisitors( $visitors ): void {
		$this->visitors = $visitors;
	}

	/**
	 * @return mixed
	 */
	public function getTypeVisit() {
		return $this->typeVisit;
	}

	/**
	 * @param mixed $typeVisit
	 */
	public function setTypeVisit( $typeVisit ): void {
		$this->typeVisit = $typeVisit;
	}

	/**
	 * @return mixed
	 */
	public function getPaymentvalid() {
		return $this->paymentvalid;
	}

	/**
	 * @param mixed $paymentvalid
	 */
	public function setPaymentvalid( $paymentvalid ): void {
		$this->paymentvalid = $paymentvalid;
	}


	/**
	 * @param Visitor $visitor
	 *
	 * @return $this
	 */
	public function addVisitor( Visitor $visitor ) {
		$this->visitors[] = $visitor;
		$visitor->setBooking( $this );


		return $this;
	}

	/**
	 * @param Visitor $visitor
	 */

	public function removeVisitor(Visitor $visitor)
	{
		$this->visitors->removeElement($visitor);
	}


	/**
	 * @return mixed
	 */
	public function getBookingCode() {
		return $this->bookingCode;
	}

	/**
	 * @param mixed $bookingCode
	 */
	public function setBookingCode( $bookingCode ) {
		$this->bookingCode = $bookingCode;
	}

	public function generateBookingCode($length = 10)
	{
		$characters = '0123456789';
		$lenghtMax = strlen($characters);
		$bookingCode = 'RESA';
		for ($i = 0; $i < $length; $i++)
		{
			$bookingCode .= $characters[rand(0, $lenghtMax - 1)];
		}
		return $bookingCode;
	}

	    public function getTotalAmount()
	    {
		    $totalAmount = 0;
		    foreach ($this->getVisitors() as $visitor){
			    $price = $visitor->getPrice();
			    $totalAmount += $price;
		    }

		    return $totalAmount;
	    }
}
