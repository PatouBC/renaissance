<?php

namespace App\Controller;

use App\Entity\Dayparttype;
use App\Form\DayparttypeType;
use App\Repository\DayparttypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dayparttype")
 */
class DayparttypeController extends AbstractController
{
    /**
     * @Route("/", name="dayparttype_index", methods={"GET"})
     */
    public function index(DayparttypeRepository $dayparttypeRepository): Response
    {
        return $this->render('dayparttype/index.html.twig', [
            'dayparttypes' => $dayparttypeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="dayparttype_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $dayparttype = new Dayparttype();
        $form = $this->createForm(DayparttypeType::class, $dayparttype);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($dayparttype);
            $entityManager->flush();

            return $this->redirectToRoute('dayparttype_index');
        }

        return $this->render('dayparttype/new.html.twig', [
            'dayparttype' => $dayparttype,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="dayparttype_show", methods={"GET"})
     */
    public function show(Dayparttype $dayparttype): Response
    {
        return $this->render('dayparttype/show.html.twig', [
            'dayparttype' => $dayparttype,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="dayparttype_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Dayparttype $dayparttype): Response
    {
        $form = $this->createForm(DayparttypeType::class, $dayparttype);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('dayparttype_index', [
                'id' => $dayparttype->getId(),
            ]);
        }

        return $this->render('dayparttype/edit.html.twig', [
            'dayparttype' => $dayparttype,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="dayparttype_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Dayparttype $dayparttype): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dayparttype->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($dayparttype);
            $entityManager->flush();
        }

        return $this->redirectToRoute('dayparttype_index');
    }
}
