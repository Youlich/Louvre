<?php

namespace App\services;

use Symfony\Component\Translation\TranslatorInterface;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class SendMail  extends \Twig_Extension {


	private $twig;


	public function __construct(\Twig_Environment $twig)
	{
		$this->twig = $twig;
	}

	public function Mail($booking, TranslatorInterface $translator) {
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



    public function SendMail($booking, TranslatorInterface $translator) {
	    $typeVisit = $booking->getTypeVisit();
		$mail = new PHPmailer();
		$mail->isSMTP(); // Paramétrer le Mailer pour utiliser SMTP
		$mail->Host = 'smtp.gmail.com'; // Spécifier le serveur SMTP
		$mail->SMTPAuth = true; // Activer authentication SMTP
		$mail->Username = 'billetteriemuseedulouvre@gmail.com'; // Votre adresse email d'envoi
		$mail->Password = 'Soleil123!'; // Le mot de passe de cette adresse email
		$mail->SMTPSecure = 'ssl'; // Accepter SSL
		$mail->Port = 465;

		$mail->setFrom('billetteriemuseedulouvre@gmail.com', 'Musée du Louvre'); // Personnaliser l'envoyeur
		$mail->addAddress($booking->getEmail()); // Ajouter le destinataire
		//$mail->addReplyTo('info@example.com', 'Information'); // L'adresse de réponse
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');

		//$mail->addAttachment('/var/tmp/file.tar.gz'); // Ajouter un attachement
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');
		$mail->isHTML(true); // Paramétrer le format des emails en HTML ou non

		$mail->Subject = $translator->trans('mail.subject');
		$mail->Body = $this->twig->render(
			'emails/sendBooking.html.twig',
			array('booking' => $booking,
			      'typeVisit' => $typeVisit,
			)
		);
		//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		$mail->send();

	}
}