<?php

namespace App\Controller;

use App\Entity\Typeconsult;
use App\Form\TypeconsultType;
use App\Repository\TypeconsultRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/typeconsult")
 */
class TypeconsultController extends AbstractController
{
    /**
     * @Route("/", name="typeconsult_index", methods={"GET"})
     */
    public function index(TypeconsultRepository $typeconsultRepository): Response
    {
        return $this->render('typeconsult/index.html.twig', [
            'typeconsults' => $typeconsultRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="typeconsult_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $typeconsult = new Typeconsult();
        $form = $this->createForm(TypeconsultType::class, $typeconsult);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typeconsult);
            $entityManager->flush();

            return $this->redirectToRoute('typeconsult_index');
        }

        return $this->render('typeconsult/new.html.twig', [
            'typeconsult' => $typeconsult,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="typeconsult_show", methods={"GET"})
     */
    public function show(Typeconsult $typeconsult): Response
    {
        return $this->render('typeconsult/show.html.twig', [
            'typeconsult' => $typeconsult,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="typeconsult_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Typeconsult $typeconsult): Response
    {
        $form = $this->createForm(TypeconsultType::class, $typeconsult);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('typeconsult_index', [
                'id' => $typeconsult->getId(),
            ]);
        }

        return $this->render('typeconsult/edit.html.twig', [
            'typeconsult' => $typeconsult,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="typeconsult_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Typeconsult $typeconsult): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeconsult->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typeconsult);
            $entityManager->flush();
        }

        return $this->redirectToRoute('typeconsult_index');
    }
}
