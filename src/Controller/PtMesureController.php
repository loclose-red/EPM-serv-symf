<?php

namespace App\Controller;

use App\Entity\PtMesure;
use App\Form\PtMesureType;
use App\Repository\PtMesureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ptmesure")
 */
class PtMesureController extends AbstractController
{
    /**
     * @Route("/", name="pt_mesure_index", methods={"GET"})
     */
    public function index(PtMesureRepository $ptMesureRepository): Response
    {
        return $this->render('pt_mesure/index.html.twig', [
            'pt_mesures' => $ptMesureRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="pt_mesure_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ptMesure = new PtMesure();
        $form = $this->createForm(PtMesureType::class, $ptMesure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ptMesure);
            $entityManager->flush();

            return $this->redirectToRoute('pt_mesure_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pt_mesure/new.html.twig', [
            'pt_mesure' => $ptMesure,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="pt_mesure_show", methods={"GET"})
     */
    public function show(PtMesure $ptMesure): Response
    {
        return $this->render('pt_mesure/show.html.twig', [
            'pt_mesure' => $ptMesure,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="pt_mesure_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PtMesure $ptMesure): Response
    {
        $form = $this->createForm(PtMesureType::class, $ptMesure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pt_mesure_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pt_mesure/edit.html.twig', [
            'pt_mesure' => $ptMesure,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="pt_mesure_delete", methods={"POST"})
     */
    public function delete(Request $request, PtMesure $ptMesure): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ptMesure->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ptMesure);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pt_mesure_index', [], Response::HTTP_SEE_OTHER);
    }
}
