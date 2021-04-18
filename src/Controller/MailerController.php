<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class MailerController extends AbstractController
{
    /**
     * @Route("/email")
     */

    public function sendEmail(MailerInterface $mailer)
    {
        $nom = 'Bonjour Sébastien';

        $email = (new TemplatedEmail())
            ->from(new Address('scidevergnes@gmail.com', 'SCI de VERGNES'))
            ->to(new Address('eugenio.paniagua@icloud.com'))
            ->subject('Le temps est venu de Symfony Mailer!')
            ->text('Envoyer facilement un emails')
            ->htmlTemplate('emails/loyer.html.twig')

            ->context([
                'date' => new \DateTime(),
                'nom' => $nom,
            ]);


        // $mailer->send($email);
        return $this->render('emails/loyer.html.twig',[
            'date' => new \DateTime(),
                'nom' => $nom,
            ]);
    }
}
