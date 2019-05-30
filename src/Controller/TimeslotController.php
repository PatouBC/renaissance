<?php

namespace App\Controller;

use App\Entity\Timeslot;
use App\Form\TimeslotType;
use App\Repository\TimeslotRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/timeslot")
 */
class TimeslotController extends AbstractController
{
    /**
     * @Route("/", name="timeslot_index", methods={"GET"})
     */
    public function index(TimeslotRepository $timeslotRepository): Response
    {
        return $this->render('timeslot/index.html.twig', [
            'mainNavTime' => true,
            'timeslots' => $timeslotRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="timeslot_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $timeslot = new Timeslot();
        $form = $this->createForm(TimeslotType::class, $timeslot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($timeslot);
            $entityManager->flush();

            return $this->redirectToRoute('timeslot_index');
        }

        return $this->render('timeslot/new.html.twig', [
            'timeslot' => $timeslot,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="timeslot_show", methods={"GET"})
     */
    public function show(Timeslot $timeslot): Response
    {
        return $this->render('timeslot/show.html.twig', [
            'timeslot' => $timeslot,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="timeslot_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Timeslot $timeslot): Response
    {
        $form = $this->createForm(TimeslotType::class, $timeslot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('timeslot_index', [
                'id' => $timeslot->getId(),
            ]);
        }

        return $this->render('timeslot/edit.html.twig', [
            'timeslot' => $timeslot,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="timeslot_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Timeslot $timeslot): Response
    {
        if ($this->isCsrfTokenValid('delete'.$timeslot->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($timeslot);
            $entityManager->flush();
        }

        return $this->redirectToRoute('timeslot_index');
    }
}
