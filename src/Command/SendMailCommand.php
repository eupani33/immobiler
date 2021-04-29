<?php

namespace App\Command;

use Knp\Snappy\Pdf;
use Twig\Environment;
use App\Repository\UserRepository;
use App\Repository\LoyerRepository;
use Symfony\Component\Mime\Address;
use App\Repository\ArticleRepository;
use Symfony\Component\Mime\NamedAddress;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SendMailCommand extends Command
{
    protected static $defaultName = 'SendMail';
    private $userRepository;
    private $mailer;
    private $twig;
    private $pdf;

    public function __construct(LoyerRepository $loyerRepository, MailerInterface $mailer, Environment $twig, Pdf $pdf)
    {
        parent::__construct(null);
        $this->userRepository = $loyerRepository;
        $this->mailer = $mailer;
        $this->twig = $twig;
        $this->pdf = $pdf;
    }

    protected function configure()
    {
        $this
             ->setDescription('Envoi mensuel des quittances de loyers');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $loyer = $this->loyerRepository
            ->findAllLoyerToMailer();

        $io->progressStart(count($loyer));

        foreach ($loyer as $loyers) {
            $io->progressAdvance();
            $loyers = $this->loyerRepository
                ->find($locataire);
            // Skip authors who do not have published articles for the last week
            if (count($loyers) === 0) {
                continue;
            }
            $html = $this->twig->render('email/quittance.html.twig', [
                'loyer' => $loyers,
            ]);

            $pdf = $this->pdf->getOutputFromHtml($html);

            $email = (new TemplatedEmail())
                ->from(new Address('alienmailcarrier@example.com', 'The Space Bar'))
                ->to(new Address($locataire->getEmail(), $locataire->getFirstName()))
                ->subject('Your weekly report on the Space Bar!')
                ->htmlTemplate('email/quittance.html.twig')
                ->context([
                    'loyers' => $loyers,
                ])
                ->attach($pdf, sprintf('quittance-%s.pdf', date('Y-m-d')));
            $this->mailer->send($email);
        }
        $io->progressFinish();
        $io->success('tous les mails ont été envoyés!');
    }
}
