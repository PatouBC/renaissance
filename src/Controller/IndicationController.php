<?php

namespace App\Controller;

use App\Entity\Indication;
use App\Form\IndicationType;
use App\Repository\IndicationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/indication")
 */
class IndicationController extends AbstractController
{
    /**
     * @Route("/", name="indication_index", methods={"GET"})
     */
    public function index(IndicationRepository $indicationRepository): Response
    {
        return $this->render('indication/index.html.twig', [
            'indications' => $indicationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="indication_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $indication = new Indication();
        $form = $this->createForm(IndicationType::class, $indication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($indication);
            $entityManager->flush();

            return $this->redirectToRoute('indication_index');
        }

        return $this->render('indication/new.html.twig', [
            'indication' => $indication,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="indication_show", methods={"GET"})
     */
    public function show(Indication $indication): Response
    {
        return $this->render('indication/show.html.twig', [
            'indication' => $indication,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="indication_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Indication $indication): Response
    {
        $form = $this->createForm(IndicationType::class, $indication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('indication_index', [
                'id' => $indication->getId(),
            ]);
        }

        return $this->render('indication/edit.html.twig', [
            'indication' => $indication,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="indication_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Indication $indication): Response
    {
        if ($this->isCsrfTokenValid('delete'.$indication->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($indication);
            $entityManager->flush();
        }

        return $this->redirectToRoute('indication_index');
    }
}
