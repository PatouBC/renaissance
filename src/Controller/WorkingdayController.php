<?php

namespace App\Controller;

use App\Entity\Workingday;
use App\Form\WorkingdayType;
use App\Repository\WorkingdayRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/workingday")
 */
class WorkingdayController extends AbstractController
{
    /**
     * @Route("/", name="workingday_index", methods={"GET"})
     */
    public function index(WorkingdayRepository $workingdayRepository): Response
    {
        return $this->render('workingday/index.html.twig', [
            'workingdays' => $workingdayRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="workingday_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $workingday = new Workingday();
        $form = $this->createForm(WorkingdayType::class, $workingday);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($workingday);
            $entityManager->flush();

            return $this->redirectToRoute('workingday_index');
        }

        return $this->render('workingday/new.html.twig', [
            'workingday' => $workingday,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="workingday_show", methods={"GET"})
     */
    public function show(Workingday $workingday): Response
    {
        return $this->render('workingday/show.html.twig', [
            'workingday' => $workingday,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="workingday_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Workingday $workingday): Response
    {
        $form = $this->createForm(WorkingdayType::class, $workingday);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('workingday_index', [
                'id' => $workingday->getId(),
            ]);
        }

        return $this->render('workingday/edit.html.twig', [
            'workingday' => $workingday,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="workingday_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Workingday $workingday): Response
    {
        if ($this->isCsrfTokenValid('delete'.$workingday->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($workingday);
            $entityManager->flush();
        }

        return $this->redirectToRoute('workingday_index');
    }
}
