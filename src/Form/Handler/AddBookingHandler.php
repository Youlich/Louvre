<?php
namespace App\Form\Handler;

use App\services\VerifDateVisit;
use App\services\VerifDateVisitHour;
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
	 * @var VerifDateVisitHour
	 */
	private $verifDateVisitHour;
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
		VerifDateVisitHour $verifDateVisitHour,
		VerifDateVisit $verifdatevisit,
		VerifStock $verifStock,
		SessionInterface $session,
		EntityManagerInterface $entityManager)
	{
		$this->verifdatevisithour = $verifDateVisitHour;
		$this->verifdatevisit = $verifdatevisit;
		$this->verifstock = $verifStock;
		$this->session = $session;
		$this->entityManager = $entityManager;
	}
	public function handle(FormInterface $formbooking, TranslatorInterface $translator):bool
	{
		if ($formbooking->isSubmitted() && $formbooking->isValid()) {
			$booking = $formbooking->getData();
			if ($this->verifdatevisithour->ValidDateHour($booking->getDateVisit(),$booking)) {
                    if ($this->verifdatevisit->ValidDate($booking->getDateVisit())) {
					if ( $this->verifstock->ValidStock( $booking->getDateVisit() ) ) {
						$this->entityManager->persist( $booking );
						$this->entityManager->flush();

						return true;
					} else {
						$this->session->getFlashBag()->add( 'message', $translator->trans( 'error.booking.stock' ) );
					}
				}else {
	                    $this->session->getFlashBag()->add('message', $translator->trans('error.dateVisit.date'));
				}

			} else {
				$this->session->getFlashBag()->add('message', $translator->trans('error.booking.hour'));
			}
		}
		return false;
	}
}