<?php

namespace App\Controller;

use App\Repository\EcritureRepository;
use Symfony\UX\Chartjs\Model\Chart;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ChartBuilderInterface $chartBuilder, EcritureRepository $ecritureRepository): Response
    {
        $valeurs = $ecritureRepository->Findstat('%2021%');

        $annee = [];
        $m1 = $m2 = $m3 = $m4 = $m5 = $m6 = 0;
        $m7 = $m8 = $m9 = $m10 = $m11 = $m12 = 0;


        foreach ($valeurs as $data) {

                switch ($data["mois"]->format('m')) {
                    case 1:
                        $annee['janvier'] =  $m1 = $m1 + $data["Ca"];
                        break;
                    case 2:
                        $annee['Février'] = $m2 = ($m2 + $data["Ca"]);
                        break;
                    case 3:
                        $annee['Mars'] = $m3 = $m3 +  $data["Ca"];
                        break;
                    case 4:
                        $annee['Avril'] = $m4 = $m4 +  $data["Ca"];
                        break;
                    case 5:
                        $annee['Mai'] = $m5 = $m5 +  $data["Ca"];
                        break;
                    case 6:
                        $annee['Juin'] = $m6 = $m6 +  $data["Ca"];
                        break;
                    case 7:
                        $annee['Juillet'] = $m7 = $m7 +  $data["Ca"];
                        break;
                    case 8:
                        $annee['Aout'] = $m8 = $m8 +  $data["Ca"];
                        break;
                    case 9:
                        $annee['Septembre'] = $m9 = $m9 +  $data["Ca"];
                        break;
                    case 10:
                        $annee['Octobre'] = $m10 = $m10 +  $data["Ca"];
                        break;
                    case 11:
                        $annee['Novembre'] = $m11 = $m11 +  $data["Ca"];
                        break;
                    case 12:
                        $annee['Décembre'] = $m12 = $m12 +  $data["Ca"];
                
            }
        }

        $label_x = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
        $donnee_y = [$m1, $m2, $m3, $m4, $m5, $m6, $m7, $m8, $m9, $m10, $m11, $m12];
        $chart = $chartBuilder->createChart(Chart::TYPE_LINE);
        $chart->setData([
            'labels' => $label_x,
            'datasets' => [
                [
                    'label' => 'Evolution des Loyers',
                    'backgroundColor' => 'rgb(255, 99, 132)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => $donnee_y,
                ],
            ]
        ]);

        $chart->setOptions([]);

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'stat' => $chart,
            'donnees' => $annee,
        ]);
    }
}
