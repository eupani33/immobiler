<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Contrat;
use App\Entity\Ecriture;
use App\Entity\Local;
use App\Entity\Loyer;
use App\Form\LoyerType;
use App\Repository\ContratRepository;
use App\Repository\LoyerRepository;
use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * @Route("/loyer")
 */
class LoyerController extends AbstractController
{
    function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    /**
     * @Route("/saisie/{id}", name="saisie_loyer")
     */
    public function saisie_Loyer($id, Request $request)
    {

        $this->em->flush();
        $ecriture = new Ecriture();
        $loyer = $this->getDoctrine()->getRepository(Loyer::class)->find($id);
        $loyer->setStatus(false);
        $ecriture->setDate($loyer->getDatePaiement());
        $ecriture->setType($loyer->gettypes());
        $ecriture->setLibelle($loyer->getLocataireInfo());

        $ecriture->setMontant($loyer->getPaiement());
        $ecriture->setPointage(false);
        $ecriture->setCategorie($this->getDoctrine()->getRepository(Categorie::class)->find(1));
        $ecriture->setLocal($loyer->getLocal());


        $this->em->persist($ecriture);
        $this->em->persist($loyer);
        $this->em->flush();

        $this->addFlash('info', 'Ajout realisé en Banque');
        return $this->redirectToRoute('loyer_index');
    }



    /**
     * @Route("/", name="loyer_index", methods={"GET"})
     */
    public function index(LoyerRepository $loyerRepository): Response
    {

        return $this->render('loyer/index.html.twig', [
            'loyers' => $loyerRepository->FindAllActif(),
        ]);
    }

    /**
     * @Route("/new", name="loyer_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $loyer = new Loyer();

        $form = $this->createForm(LoyerType::class, $loyer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->em->persist($loyer);
            $$this->em->flush();

            return $this->redirectToRoute('loyer_index');
        }

        return $this->render('loyer/new.html.twig', [
            'loyer' => $loyer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="loyer_show", methods={"GET"})
     */
    public function show(Loyer $loyer): Response
    {
        return $this->render('loyer/show.html.twig', [
            'loyer' => $loyer,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="loyer_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Loyer $loyer): Response
    {
        $form = $this->createForm(LoyerType::class, $loyer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($loyer->getPaiement() == $loyer->getMontantTot()) {
                $loyer->setStatus = false;
                $this->em->persist($loyer);
            }
            $this->em->flush();

            // return $this->redirectToRoute('loyer_index');
        }

        return $this->render('loyer/edit.html.twig', [
            'loyer' => $loyer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="loyer_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Loyer $loyer): Response
    {
        if ($this->isCsrfTokenValid('delete' . $loyer->getId(), $request->request->get('_token'))) {
            $this->em->remove($loyer);
            $this->em->flush();
        }

        return $this->redirectToRoute('loyer_index');
    }
}
