<?php

namespace App\Controller;

use App\Entity\DayPartType;
use App\Form\DayPartTypeType;
use App\Repository\DayPartTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dayparttype", host="renaissance-terrehappy.fr")
 */
class DayPartTypeController extends AbstractController
{
    /**
     * @Route("/", name="day_part_type_index", methods={"GET"})
     */
    public function index(DayPartTypeRepository $dayPartTypeRepository): Response
    {
        return $this->render('day_part_type/index.html.twig', [
            'day_part_types' => $dayPartTypeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="day_part_type_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $dayPartType = new DayPartType();
        $form = $this->createForm(DayPartTypeType::class, $dayPartType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($dayPartType);
            $entityManager->flush();

            return $this->redirectToRoute('day_part_type_index');
        }

        return $this->render('day_part_type/new.html.twig', [
            'day_part_type' => $dayPartType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="day_part_type_show", methods={"GET"})
     */
    public function show(DayPartType $dayPartType): Response
    {
        return $this->render('day_part_type/show.html.twig', [
            'day_part_type' => $dayPartType,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="day_part_type_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, DayPartType $dayPartType): Response
    {
        $form = $this->createForm(DayPartTypeType::class, $dayPartType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('day_part_type_index', [
                'id' => $dayPartType->getId(),
            ]);
        }

        return $this->render('day_part_type/edit.html.twig', [
            'day_part_type' => $dayPartType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="day_part_type_delete", methods={"DELETE"})
     */
    public function delete(Request $request, DayPartType $dayPartType): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dayPartType->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($dayPartType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('day_part_type_index');
    }
}
