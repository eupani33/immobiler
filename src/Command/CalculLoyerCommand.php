<?php

namespace App\Command;

use App\Entity\Contrat;
use App\Entity\Locataire;
use App\Entity\Loyer;
use App\Entity\Local;
use App\Repository\ContratRepository;
use App\Repository\LocalRepository;
use App\Repository\LocataireRepository;
use DateTime;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Doctrine\ORM\EntityManagerInterface;

class CalculLoyerCommand extends Command
{
    protected static $defaultName = 'creation-loyer';
    protected static $defaultDescription = 'Application pour automatiser le loyer';


    private $em;

    private $contratRepository;

    public function __construct(EntityManagerInterface $em, ContratRepository $contratRepository, LocataireRepository $locataireRepository, LocalRepository $localRepository)
    {
        $this->em = $em;
        $this->contratRepository = $contratRepository;
        $this->locataireRepository = $locataireRepository;
        $this->localRepository = $localRepository;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Calcul des Loyers pour un mois qui est passé en paramêtre')
            ->addArgument('mois', InputArgument::REQUIRED, 'mois du calcul');
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg = $input->getArgument('mois');

        $moisLettre = [
            "01" => "Janvier",
            "02" => "Février",
            "03" => "Mars",
            "04" => "Avril",
            "05" => "Mai",
            "06" => "Juin",
            "07" => "Juillet",
            "08" => "Août",
            "09" => "Septembre",
            "10" => "Octobre",
            "11" => "Novembre",
            "12" => "Décembre"
        ];



        if (in_array($arg, range(1, 12))) {
            $periodeDu = new DateTime();
            $periodeAu = new DateTime();
            $année = date("Y");
            $mois = $arg;
            $jourDebut = '01';
            $jourFin = cal_days_in_month(CAL_GREGORIAN, $mois, $année);
            $periodeDu->setDate($année, $mois, $jourDebut);
            $periodeAu->setDate($année, $mois, $jourFin);
            $messageLoyer = 'Loyer ' . $moisLettre[$mois] . ' ' . $année;
            $messagePeriodeAu = 'du ' . $jourDebut . ' au ' . $jourFin . ' ' . $moisLettre[$mois];
        }

        $contrats = $this->contratRepository->findActif();
        foreach ($contrats as $ligne) {

            $loyer = new Loyer();

            $loyer->setContrat($this->em->getRepository(Contrat::class)->find($ligne->getId()));
            $loyer->setNom($messageLoyer);
            $loyer->setMontantTot($ligne->getLoyer() + $ligne->getCharges());
            $loyer->setLoyer($ligne->getLoyer());
            $loyer->setCharge($ligne->getCharges());
            $loyer->setMail(false);
            $loyer->setStatus(true);
            $loyer->setPeriodeDu($periodeDu);
            $loyer->setPeriodeAu($periodeAu);
            $locataire = $this->em->getRepository(Locataire::class)->find($ligne->getLocataire());
            $local = $this->em->getRepository(Local::class)->find($ligne->getLocal());
            $loyer->setLocataireInfo($locataire->getCivilite() . ' ' . $locataire->getNom() . ' ' . $locataire->getPrenom());
            $loyer->setLocalInfo($local->getNom() . ' ' . $local->getAdresse() . ' ' . $local->getCp(). ' ' . $local->getVille());
            $loyer->setLocal($ligne->getLocal());

            $this->em->persist($loyer);
        }
        $this->em->flush();


        return Command::SUCCESS;
    }
}
