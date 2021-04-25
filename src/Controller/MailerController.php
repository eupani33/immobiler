<?php

namespace App\Controller;

use App\Entity\Contrat;
use Knp\Snappy\Pdf;
use Twig\Environment;
use App\Repository\LoyerRepository;
use App\Entity\Locataire;
use App\Entity\Loyer;
use Symfony\Component\Mime\Address;
use App\Repository\LocataireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MailerController extends AbstractController
{
    private $mailer;
    private $twig;
    private $pdf;

    public function __construct(LoyerRepository $loyerRepository, MailerInterface $mailer, Environment $twig, Pdf $pdf, LocataireRepository $locataireRepository, EntityManagerInterface $em)
    {
        $this->twig = $twig;
        $this->pdf = $pdf;
        $this->mailer = $mailer;
        $this->loyerRepository = $loyerRepository;
        $this->locataireRepository = $locataireRepository;
        $this->em = $em;
    }

    /**
     * @Route("/email", name="email")
     */
    public function sendEmail(MailerInterface $mailer)
    {
        $compteur = 0;
        $baileur = 'SCI de Vergnes';
        $loyer = $this->loyerRepository
            ->findLoyerToMailer();

        foreach ($loyer as $loyers) {

            $compteur++;

            if (count($loyer) === 0) {
                continue;
            }
            $html = $this->twig->render(
                'email/quittance.html.twig',
                [
                    'loyer' => $loyers,
                    'baileur' => $baileur,
                ]
            );

            $pdf = $this->pdf->getOutputFromHtml($html);
            $contrat = $this->em->getRepository(Contrat::class)->find($loyers->getContrat());
            $locataire = $this->em->getRepository(Locataire::class)->find($contrat->getLocataire());

            $email = (new TemplatedEmail())
                ->from(new Address('scidevergnes@gmail.com', 'SCI de Vergnes'))
                ->to(new Address($locataire->getEmail(), $loyers->getLocataireInfo()))
                ->cc('scidevergnes@gmail.com')
                ->subject('Quittance Loyer')
                ->htmlTemplate('email/quittance.html.twig')
                ->context([
                    'loyer' => $loyers,
                    'baileur' => $baileur,
                ])
                ->attach($pdf, sprintf('quittance-%s.pdf', date('Y-m-d')));

            // $this->mailer->send($email);
            $this->$loyers->setMail(false);
        }
        $this->addFlash('info', 'Mail(s) envoyé(s) = ' . $compteur);
        $this->em->persist($loyer);
        $this->em->flush();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
