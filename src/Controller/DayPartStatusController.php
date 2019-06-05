<?php

namespace App\Controller;

use App\Entity\DayPartStatus;
use App\Form\DayPartStatusType;
use App\Repository\DayPartStatusRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/daypartstatus", host="renaissance-terrehappy.fr")
 */
class DayPartStatusController extends AbstractController
{
    /**
     * @Route("/", name="day_part_status_index", methods={"GET"})
     */
    public function index(DayPartStatusRepository $dayPartStatusRepository): Response
    {
        return $this->render('day_part_status/index.html.twig', [
            'day_part_statuses' => $dayPartStatusRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="day_part_status_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $dayPartStatus = new DayPartStatus();
        $form = $this->createForm(DayPartStatusType::class, $dayPartStatus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($dayPartStatus);
            $entityManager->flush();

            return $this->redirectToRoute('day_part_status_index');
        }

        return $this->render('day_part_status/new.html.twig', [
            'day_part_status' => $dayPartStatus,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="day_part_status_show", methods={"GET"})
     */
    public function show(DayPartStatus $dayPartStatus): Response
    {
        return $this->render('day_part_status/show.html.twig', [
            'day_part_status' => $dayPartStatus,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="day_part_status_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, DayPartStatus $dayPartStatus): Response
    {
        $form = $this->createForm(DayPartStatusType::class, $dayPartStatus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('day_part_status_index', [
                'id' => $dayPartStatus->getId(),
            ]);
        }

        return $this->render('day_part_status/edit.html.twig', [
            'day_part_status' => $dayPartStatus,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="day_part_status_delete", methods={"DELETE"})
     */
    public function delete(Request $request, DayPartStatus $dayPartStatus): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dayPartStatus->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($dayPartStatus);
            $entityManager->flush();
        }

        return $this->redirectToRoute('day_part_status_index');
    }
}
