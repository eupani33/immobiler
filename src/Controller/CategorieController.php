<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Classe;
use App\Repository\ClasseRepository;
use App\Form\CategorieType;
use App\Form\ClasseType;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\Query\ResultSetMapping;


/**
 * @Route("/categorie")
 */
class CategorieController extends AbstractController
{
    /**
     * @Route("/", name="categorie_index", methods={"GET"})
     */
    public function index(CategorieRepository $categorieRepository): Response
    {

        return $this->render('categorie/index.html.twig', [
            'categories' => $categorieRepository->findByClasse(),
        ]);
    }

    /**
     * @Route("/new", name="categorie_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $categorie = new Categorie();

        $form = $this->createForm(CategorieType::class, $categorie);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categorie);
            $entityManager->flush();

            return $this->redirectToRoute('categorie_index');
        }

        return $this->render('categorie/new.html.twig', [
            'categorie' => $categorie,
            'form' => $form->createView(),
        ]);
    }

     
    /**
     * @Route("/{id}/edit", name="categorie_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Categorie $categorie): Response
    {

        $form = $this->createForm(CategorieType::class, $categorie);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('categorie_index');
        }

        return $this->render('categorie/edit.html.twig', [
            'categorie' => $categorie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="categorie_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Categorie $categorie): Response
    {
        if ($this->isCsrfTokenValid('delete' . $categorie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($categorie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('categorie_index');
    }
}
