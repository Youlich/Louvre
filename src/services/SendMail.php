<?php

namespace App\services;

use Symfony\Component\Translation\TranslatorInterface;


class SendMail  extends \Twig_Extension {

	private $mailer;
	private $twig;


	public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig )
	{
		$this->mailer = $mailer;
		$this->twig = $twig;
	}

	public function sendMail($booking, TranslatorInterface $translator) {
		$typeVisit = $booking->getTypeVisit();
		$message = new \Swift_Message($translator->trans('mail.title'));

        $message
			->setSubject($translator->trans('mail.subject'))
			->setFrom('billetteriemuseedulouvre@gmail.com')
			->setTo($booking->getEmail())
			->setBody(
				$this->twig->render(
					'emails/sendBooking.html.twig',
					array('booking' => $booking,
					      'typeVisit' => $typeVisit,
					    					)
				),
				'text/html'
			);

		$this->mailer->send($message);
	}

}