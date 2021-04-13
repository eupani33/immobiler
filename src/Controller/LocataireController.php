<?php

namespace App\Controller;

use App\Entity\Locataire;
use App\Form\LocataireType;
use App\Repository\LocataireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/locataire")
 */
class LocataireController extends AbstractController
{
    /**
     * @Route("/", name="locataire_index", methods={"GET"})
     */
    public function index(LocataireRepository $locataireRepository): Response
    {
        return $this->render('locataire/index.html.twig', [
            'locataires' => $locataireRepository->findActif(),
        ]);
    }

    /**
     * @Route("/new", name="locataire_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $locataire = new Locataire();
        $form = $this->createForm(LocataireType::class, $locataire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($locataire);
            $entityManager->flush();

            return $this->redirectToRoute('locataire_index');
        }

        return $this->render('locataire/new.html.twig', [
            'locataire' => $locataire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="locataire_show", methods={"GET"})
     */
    public function show(Locataire $locataire): Response
    {
        return $this->render('locataire/show.html.twig', [
            'locataire' => $locataire,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="locataire_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Locataire $locataire): Response
    {
        $form = $this->createForm(LocataireType::class, $locataire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('locataire_index');
        }

        return $this->render('locataire/edit.html.twig', [
            'locataire' => $locataire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="locataire_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Locataire $locataire): Response
    {
        if ($this->isCsrfTokenValid('delete'.$locataire->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($locataire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('locataire_index');
    }
}
