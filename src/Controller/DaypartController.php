<?php

namespace App\Controller;

use App\Entity\Daypart;
use App\Form\DaypartType;
use App\Repository\DaypartRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/daypart")
 */
class DaypartController extends AbstractController
{
    /**
     * @Route("/", name="daypart_index", methods={"GET"})
     */
    public function index(DaypartRepository $daypartRepository): Response
    {
        return $this->render('daypart/index.html.twig', [
            'mainNavDaypart' => true,
            'dayparts' => $daypartRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="daypart_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $daypart = new Daypart();
        $form = $this->createForm(DaypartType::class, $daypart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($daypart);
            $entityManager->flush();

            return $this->redirectToRoute('daypart_index');
        }

        return $this->render('daypart/new.html.twig', [
            'daypart' => $daypart,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="daypart_show", methods={"GET"})
     */
    public function show(Daypart $daypart): Response
    {
        return $this->render('daypart/show.html.twig', [
            'daypart' => $daypart,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="daypart_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Daypart $daypart): Response
    {
        $form = $this->createForm(DaypartType::class, $daypart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('daypart_index', [
                'id' => $daypart->getId(),
            ]);
        }

        return $this->render('daypart/edit.html.twig', [
            'daypart' => $daypart,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="daypart_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Daypart $daypart): Response
    {
        if ($this->isCsrfTokenValid('delete'.$daypart->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($daypart);
            $entityManager->flush();
        }

        return $this->redirectToRoute('daypart_index');
    }
}
