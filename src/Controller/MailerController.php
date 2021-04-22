<?php

namespace App\Controller;

use Knp\Snappy\Pdf;
use App\Entity\Loyer;
use Twig\Environment;
use App\Repository\LoyerRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mime\Address;

class MailerController extends AbstractController
{
    private $twig;
    private $pdf;

    public function __construct(LoyerRepository $loyerRepository, MailerInterface $mailer, Environment $twig, Pdf $pdf)
    {
        $this->twig = $twig;
        $this->pdf = $pdf;
    }



    /**
     * @Route("/email", name="email")
     */

    public function sendEmail(MailerInterface $mailer)
    {
        $base = 500;
        $charge = 30;
        $loyer =  $base + $charge;
        $adresse = '20 place Maucaillou 33000 Bordeaux';
        $baileur = 'SCI de Vergnes';
        $nom = 'PANIAGUA Pascale';
        $periodeDu = '01/04/2021';
        $periodeAu = '31/04/2021';
        $mois = 'Avril 2021';
        $paiement = 525;
        $filename = 'pdf/Quittance-' . rand(1,1000) . '-' . date('m-Y') . '.pdf';
        $filename = 'pdf/Quittance-' . $nom . '-' . date('d-m-Y') . '.pdf';

        $snappy = new Pdf('/usr/local/bin/wkhtmltopdf');
       
        $snappy->generateFromHtml(
            $this->renderView('email/quittance.html.twig', array(
                'date' => new \DateTime(),
                'nom' => $nom,
                'baileur' => $baileur,
                'montant' => $loyer,
                'base' => $base,
                'charge' => $charge,
                "periodeDu" => $periodeDu,
                "periodeAu" => $periodeAu,
                "adresse" => $adresse,
                "mois" => $mois,
                "paiement" => $paiement,
            )),$filename
        );

        $email = (new TemplatedEmail())
            ->from(new Address('scidevergnes@gmail.com', 'SCI de VERGNES'))
            ->to(new Address('pascale.paniagua@gmail.com'))
            ->subject('Quittance Loyer')
            ->attach(fopen($filename, 'r'));

        $mailer->send($email);
        $this->addFlash(
            'info',
            'Mail envoyé'
        );

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
