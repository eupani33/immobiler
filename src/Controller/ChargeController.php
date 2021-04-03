<?php

namespace App\Controller;

use App\Entity\Charge;
use App\Entity\Fournisseur;
use App\Form\ChargeType;
use App\Repository\ChargeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

/**
 * @Route("/charge")
 */
class ChargeController extends AbstractController
{
    /**
     * @Route("/", name="charge_index", methods={"GET"})
     */
    public function index(ChargeRepository $chargeRepository): Response
    {
        return $this->render('charge/index.html.twig', [
            'charges' => $chargeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="charge_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $charge = new Charge();
        $form = $this->createForm(ChargeType::class, $charge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($charge);

            return $this->redirectToRoute('charge_index');
        }

        return $this->render('charge/new.html.twig', [
            'charge' => $charge,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="charge_show", methods={"GET"})
     */
    public function show(Charge $charge): Response
    {
        return $this->render('charge/show.html.twig', [
            'charge' => $charge,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="charge_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Charge $charge): Response
    {
        $form = $this->createForm(ChargeType::class, $charge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('charge_index');
        }

        return $this->render('charge/edit.html.twig', [
            'charge' => $charge,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/duplique", name="charge_duplique", methods={"GET","POST"})
     */
    public function duplique(Request $request, Charge $charge): Response
    {
        $fournisseurs = $charge->getFournisseur();
        $libelle = $charge->getLibelle();
        $montant = $charge->getMontant();

        $charge = new Charge($charge);
        $charge->setFournisseur($fournisseurs);
        $charge->setLibelle($libelle);
        $charge->setMontant($montant);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($charge);
        
        $form = $this->createForm(ChargeType::class, $charge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('charge_index');
        }

        return $this->render('charge/edit.html.twig', [
            'charge' => $charge,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="charge_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Charge $charge): Response
    {
        if ($this->isCsrfTokenValid('delete' . $charge->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($charge);
            $entityManager->flush();
        }

        return $this->redirectToRoute('charge_index');
    }
}
