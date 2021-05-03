<?php

namespace App\Controller;

use DateTime;
use Knp\Snappy\Pdf;
use App\Entity\Local;
use App\Entity\Loyer;
use Twig\Environment;
use App\Entity\Contrat;
use App\Entity\Locataire;
use App\Repository\LoyerRepository;
use Symfony\Component\Mime\Address;
use App\Repository\ContratRepository;
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


    public function __construct(LoyerRepository $loyerRepository, MailerInterface $mailer, Environment $twig, Pdf $pdf, LocataireRepository $locataireRepository, ContratRepository $contratRepository, EntityManagerInterface $em)
    {
        $this->twig = $twig;
        $this->pdf = $pdf;
        $this->mailer = $mailer;
        $this->contratRepository = $contratRepository;
        $this->loyerRepository = $loyerRepository;
        $this->locataireRepository = $locataireRepository;
        $this->em = $em;
    }

    /**
     * @Route("/email", name="email")
     */
    public function sendEmail(MailerInterface $mailer)
    {

        $baileur = 'SCI de Vergnes';
        $loyers = $this->loyerRepository->findLoyerToMailer();


        foreach ($loyers as $loyer) {

            if (count($loyers) === 0) {
                continue;
            }


            $contrat = $this->em->getRepository(Contrat::class)
                ->find($loyer->getContrat());
            $local = $this->em->getRepository(Local::class)
                ->find($loyer->getLocal());
            $locataire = $this->em->getRepository(Locataire::class)
                ->find($contrat->getLocataire());

            $html = $this->twig->render(
                'email/quittance.html.twig',
                [
                    'baileur' => $baileur,
                    'locataire' => $locataire,
                    'local' => $local,
                    'loyer' => $loyer,
                ]
            );


            $pdf = $this->pdf->getOutputFromHtml($html);
            $email = (new TemplatedEmail())
                ->from(new Address('scidevergnes@gmail.com', 'SCI de Vergnes'))
                ->to(new Address($locataire->getEmail(), $locataire->getNom() . '' . $locataire->getPrenom()))
                ->cc('scidevergnes@gmail.com')
                ->subject('Quittance Loyer')
                ->htmlTemplate('email/quittance.html.twig')
                ->context([
                    'loyer' => $loyers,
                    'baileur' => $baileur,
                ])
                ->attach($pdf, sprintf('quittance-%s.pdf', date('Y-m-d')));

            // $this->mailer->send($email);

            // $loyers->setMail = false;

            $this->addFlash('info', 'Mail envoyé à ' .  $locataire->getNom() . '' . $locataire->getPrenom());
            // $this->em->persist($loyers);
        }

        $this->em->flush();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/preavis", name="preavis")
     */
    public function sendpreavis(MailerInterface $mailer)
    {

        $baileur = 'SCI de Vergnes';
        $contrats = $this->contratRepository
            ->findPreavis();



        foreach ($contrats as $contrat) {
            $locataire = $this->em->getRepository(Locataire::class)->find($contrat->getLocataire());
            $local = $this->em->getRepository(Local::class)->find($contrat->getLocal());

            $html = $this->twig->render(
                'email/preavis.html.twig',
                [
                    'baileur' => $baileur,
                    'locataire' => $locataire,
                    'local' => $local,
                    'contrat' => $contrat,
                ]
            );

            $pdf = $this->pdf->getOutputFromHtml($html);

            $email = (new TemplatedEmail())
                ->from(new Address('scidevergnes@gmail.com', 'SCI de Vergnes'))
                ->to(new Address($locataire->getEmail(), $locataire->getNom() . '' . $locataire->getPrenom()))
                ->cc('scidevergnes@gmail.com')
                ->subject('Préavis')
                ->htmlTemplate('email/preavis.html.twig')
                ->context([
                    'baileur' => $baileur,
                    'locataire' => $locataire,
                    'local' => $local,
                    'contrat' => $contrat,
                ])
                ->attach($pdf, sprintf('preavis-%s.pdf', date('Y-m-d')));

            $this->mailer->send($email);
        }

        $this->addFlash('info', 'Mail envoyé à ' . $locataire->getPrenom() . '' . $locataire->getNom());


        return $this->render('email/preavis.html.twig', [
            'baileur' => $baileur,
            'locataire' => $locataire,
            'local' => $local,
            'contrat' => $contrat,
        ]);
        // return new Response("test");
    }
}
