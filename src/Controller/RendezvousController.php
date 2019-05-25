<?php

namespace App\Controller;

use App\Entity\Rendezvous;
use App\Form\RendezvousType;
use App\Repository\RendezvousRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/rendezvous")
 */
class RendezvousController extends AbstractController
{
    /**
     * @Route("/", name="rendezvous_index", methods={"GET"})
     */
    public function index(RendezvousRepository $rendezvousRepository): Response
    {
        return $this->render('rendezvous/index.html.twig', [
            'rendezvouses' => $rendezvousRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="rendezvous_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $rendezvous = new Rendezvous();
        $form = $this->createForm(RendezvousType::class, $rendezvous);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($rendezvous);
            $entityManager->flush();

            return $this->redirectToRoute('rendezvous_index');
        }

        return $this->render('rendezvous/new.html.twig', [
            'rendezvous' => $rendezvous,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="rendezvous_show", methods={"GET"})
     */
    public function show(Rendezvous $rendezvous): Response
    {
        return $this->render('rendezvous/show.html.twig', [
            'rendezvous' => $rendezvous,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="rendezvous_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Rendezvous $rendezvous): Response
    {
        $form = $this->createForm(RendezvousType::class, $rendezvous);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('rendezvous_index', [
                'id' => $rendezvous->getId(),
            ]);
        }

        return $this->render('rendezvous/edit.html.twig', [
            'rendezvous' => $rendezvous,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="rendezvous_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Rendezvous $rendezvous): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rendezvous->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($rendezvous);
            $entityManager->flush();
        }

        return $this->redirectToRoute('rendezvous_index');
    }
}
