<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Ecriture;
use App\Form\EcritureType;
use App\Repository\EcritureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ecriture")
 */
class EcritureController extends AbstractController
{
    /**
     * @Route("/", name="ecriture_index", methods={"GET"})
     */
    public function index(Request $request, EcritureRepository $ecriture): Response
    {
        $offset = max(0, $request->query->getInt('offset', 0));
        $paginator = $ecriture->getEcriturePaginator($offset);


        // $ecritures = $this->getDoctrine()
        //   ->getRepository(Ecriture::class)
        //   ->findAll();

        return $this->render('ecriture/index.html.twig', [
            'ecritures' => $paginator,
            'previous' => $offset - EcritureRepository::PAGINATOR_PER_PAGE,
            'next' => min(count($paginator), $offset + EcritureRepository::PAGINATOR_PER_PAGE),

        ]);
    }

    /**
     * @Route("/new", name="ecriture_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ecriture = new Ecriture();
        $form = $this->createForm(EcritureType::class, $ecriture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ecriture);
            $entityManager->flush();

            return $this->redirectToRoute('ecriture_index');
        }

        return $this->render('ecriture/new.html.twig', [
            'ecriture' => $ecriture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ecriture_show", methods={"GET"})
     */
    public function show(Ecriture $ecriture): Response
    {
        return $this->render('ecriture/show.html.twig', [
            'ecriture' => $ecriture,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ecriture_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ecriture $ecriture): Response
    {
        $form = $this->createForm(EcritureType::class, $ecriture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ecriture_index');
        }

        return $this->render('ecriture/edit.html.twig', [
            'ecriture' => $ecriture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ecriture_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Ecriture $ecriture): Response
    {
        if ($this->isCsrfTokenValid('delete' . $ecriture->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ecriture);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ecriture_index');
    }
}
