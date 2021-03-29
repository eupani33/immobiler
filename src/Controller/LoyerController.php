<?php

namespace App\Controller;

use App\Entity\Contrat;
use App\Entity\Loyer;
use App\Form\LoyerType;
use App\Repository\ContratRepository;
use App\Repository\LoyerRepository;
use DateTime;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @Route("/loyer")
 */
class LoyerController extends AbstractController
{


    /**
     * @Route("/api", name="loyer_calcul", methods={"GET"})
     */
    public function calcul_Loyer(ContratRepository $contratrepository, Request $request)
    {


        foreach ($contrats as $ligne) {

            $loyer = new Loyer();
            $identifiant = $this->getDoctrine()->getRepository(Contrat::class)->find($ligne->getId());
            $loyer->setContrat($identifiant);



            $loyer->setNom($messageLoyer);
            $loyer->setMontantTot($ligne->getLoyer() + $ligne->getCharges());
            $loyer->setLoyer($ligne->getLoyer());
            $loyer->setCharge($ligne->getCharges());
            $loyer->setStatus(1);
            $loyer->setPeriodeDu(new DateTime(date("Y") . date("m") . '01'));

            $loyer->setPeriodeAu(new DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($loyer);
            $em->flush();
        }
        return new Response('ok', 201);
    }



    /**
     * @Route("/", name="loyer_index", methods={"GET"})
     */
    public function index(LoyerRepository $loyerRepository): Response
    {

        return $this->render('loyer/index.html.twig', [
            'loyers' => $loyerRepository->findAll(),
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
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($loyer);
            $entityManager->flush();

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
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('loyer_index');
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
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($loyer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('loyer_index');
    }
}
