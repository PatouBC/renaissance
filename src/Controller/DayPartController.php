<?php

namespace App\Controller;

use App\Entity\DayPart;
use App\Form\DayPartType;
use App\Repository\DayPartRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/daypart", host="renaissance-terrehappy.fr")
 */
class DayPartController extends AbstractController
{
    /**
     * @Route("/", name="day_part_index", methods={"GET"})
     */
    public function index(DayPartRepository $dayPartRepository): Response
    {
        return $this->render('day_part/index.html.twig', [
            'day_parts' => $dayPartRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="day_part_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $dayPart = new DayPart();
        $form = $this->createForm(DayPartType::class, $dayPart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($dayPart);
            $entityManager->flush();

            return $this->redirectToRoute('day_part_index');
        }

        return $this->render('day_part/new.html.twig', [
            'day_part' => $dayPart,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="day_part_show", methods={"GET"})
     */
    public function show(DayPart $dayPart): Response
    {
        return $this->render('day_part/show.html.twig', [
            'day_part' => $dayPart,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="day_part_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, DayPart $dayPart): Response
    {
        $form = $this->createForm(DayPartType::class, $dayPart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('day_part_index', [
                'id' => $dayPart->getId(),
            ]);
        }

        return $this->render('day_part/edit.html.twig', [
            'day_part' => $dayPart,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="day_part_delete", methods={"DELETE"})
     */
    public function delete(Request $request, DayPart $dayPart): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dayPart->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($dayPart);
            $entityManager->flush();
        }

        return $this->redirectToRoute('day_part_index');
    }
}
