<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Form\Handler\AddBookingHandler;
use App\Form\BookingType;
use App\services\SendMail;
use App\services\PaymentCB;
use App\services\VerifStock;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\services\PricesCalculations;
use Symfony\Component\Translation\TranslatorInterface;


class LouvreController extends Controller {

	/**
	 * @Route("/{_locale}", defaults={"_locale": "fr"}, requirements={"_locale": "en|fr"}, name="louvre")
	 */

	public function index(Request $request) {

		return $this->render( 'louvre/index.html.twig', array(
				'prices'=> $this->getParameter('prices'),
				'locale' => $request->getLocale(),
			)
		);
	}

	/**
	 * @Route("/booking/{_locale}", defaults={"_locale": "fr"}, requirements={"_locale": "en|fr"}, name="booking")
	 */
	public function addBooking( Request $request, AddBookingHandler $addBookingHandler, VerifStock $verifstock,TranslatorInterface $translator) {

		$booking = new Booking();

		$formbooking = $this->createForm( BookingType::class, $booking, [
			'translator' => $translator,
		] );
		$booking=$formbooking->getData();
		$formbooking->handleRequest($request);
		if ($addBookingHandler->handle($formbooking, $translator)) {

			return $this->redirectToRoute( 'payment', array( 'id' => $booking->getId() ) );
        }
            return $this->render('louvre/formbooking.html.twig', array(
            'formbooking' =>$formbooking->createView(),
            'booking' => $booking,
	        'locale' => $request->getLocale(),
         ));
	}

	/**
	 * @Route("/payment/{id}/{_locale}", defaults={"_locale": "fr"}, requirements={"_locale": "en|fr"}, name="payment")
	 */
	public function payment(Request $request, PricesCalculations $calculs, $id)
	{
		$booking = $this->getDoctrine()->getManager()->getRepository(Booking::class)->find($id);

		$typeVisit = $booking->getTypeVisit();
		$tarif_total = 0;
		foreach ($booking->getVisitors() as $visitor){
			$price = $calculs->getPriceTicket($visitor, $booking);
			$visitor->setPrice($price);
			$tarif_total = $price + $tarif_total;
			$em = $this->getDoctrine()->getManager();
			$em->flush();
		}
		return $this->render('louvre/payment.html.twig', array (
			'booking' => $booking,
			'price' => $price,
			'price_total' => $tarif_total,
			'typeVisit' => $typeVisit,
			'locale' => $request->getLocale(),
		));
	}

	/**
	 * @Route("/stripe/{id}/{_locale}",defaults={"_locale": "fr"}, requirements={"_locale": "en|fr"}, name="stripe", methods="POST")
	 */
	public function stripe(Request $request, SendMail $mailer, PaymentCB $stripe, $id, TranslatorInterface $translator)
	{
		$booking = $this->getDoctrine()->getManager()->getRepository(Booking::class)->find($id);

		if ($stripe->launchingStripe($booking)) {
			$booking->setPaymentvalid(true);
			$mailer->sendMail($booking, $translator);
			$em = $this->getDoctrine()->getManager();
			$em->flush();
			$request->getSession()->getFlashBag()->add( 'success', $translator->trans('payment.ok'));
			return $this->redirectToRoute( 'payment', array( 'id' => $booking->getId() ) );
			}else {
				$request->getSession()->getFlashBag()->add('error', $translator->trans('payment.ko'));
				return $this->redirectToRoute('payment', array(
					'id' => $booking->getId(),
					'locale' => $request->getLocale(),
					));
				// The card has been declined
			}
	}

}

