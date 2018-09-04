<?php

namespace App\Form\Handler;

use App\services\VerifDateBooking;
use App\services\VerifDateVisit;
use App\services\VerifStock;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Translation\TranslatorInterface;

class AddBookingHandler
{
	/**
	 * @var VerifDateVisit
	 */
	private $verifdatevisit;
	/**
	 * @var VerifDateBooking
	 */
	private $verifdatebooking;
	/**
	 * @var VerifStock
	 */
	private $verifstock;
	/**
	 * @var SessionInterface
	 */
	private $session;
	/**
	 * @var EntityManagerInterface
	 */
	private $entityManager;

	public function __construct(
		VerifDateVisit $verifDateVisit,
		VerifDateBooking $verifDateBooking,
		VerifStock $verifStock,
		SessionInterface $session,
		EntityManagerInterface $entityManager)
	{
		$this->verifdatevisit = $verifDateVisit;
		$this->verifdatebooking = $verifDateBooking;
		$this->verifstock = $verifStock;
		$this->session = $session;
		$this->entityManager = $entityManager;
	}

	public function handle(FormInterface $formbooking, TranslatorInterface $translator):bool
	{
		if ($formbooking->isSubmitted() && $formbooking->isValid()) {
			$booking = $formbooking->getData();
			if ($this->verifdatevisit->ValidDate($booking->getDateVisit(),$booking)) {
				if ($this->verifdatebooking->ValidDate($booking->getDateBooking())) {
					if ($this->verifstock->ValidStock($booking->getDateVisit())){
						$this->entityManager->persist( $booking);
						$this->entityManager->flush();
						return true;
					} else {
						$this->session->getFlashBag()->add('message', $translator->trans('error.booking.stock'));
					}
				} else {
					$this->session->getFlashBag()->add('message', $translator->trans('error.booking.date'));
				}
			} else {
				$this->session->getFlashBag()->add('message', $translator->trans('error.booking.close'));
			}
		}
		return false;
	}
}