<?php

namespace App\Controller;

use App\Entity\Daypartstatus;
use App\Form\DaypartstatusType;
use App\Repository\DaypartstatusRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/daypartstatus")
 */
class DaypartstatusController extends AbstractController
{
    /**
     * @Route("/", name="daypartstatus_index", methods={"GET"})
     */
    public function index(DaypartstatusRepository $daypartstatusRepository): Response
    {
        return $this->render('daypartstatus/index.html.twig', [
            'daypartstatuses' => $daypartstatusRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="daypartstatus_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $daypartstatus = new Daypartstatus();
        $form = $this->createForm(DaypartstatusType::class, $daypartstatus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($daypartstatus);
            $entityManager->flush();

            return $this->redirectToRoute('daypartstatus_index');
        }

        return $this->render('daypartstatus/new.html.twig', [
            'daypartstatus' => $daypartstatus,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="daypartstatus_show", methods={"GET"})
     */
    public function show(Daypartstatus $daypartstatus): Response
    {
        return $this->render('daypartstatus/show.html.twig', [
            'daypartstatus' => $daypartstatus,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="daypartstatus_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Daypartstatus $daypartstatus): Response
    {
        $form = $this->createForm(DaypartstatusType::class, $daypartstatus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('daypartstatus_index', [
                'id' => $daypartstatus->getId(),
            ]);
        }

        return $this->render('daypartstatus/edit.html.twig', [
            'daypartstatus' => $daypartstatus,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="daypartstatus_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Daypartstatus $daypartstatus): Response
    {
        if ($this->isCsrfTokenValid('delete'.$daypartstatus->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($daypartstatus);
            $entityManager->flush();
        }

        return $this->redirectToRoute('daypartstatus_index');
    }
}
