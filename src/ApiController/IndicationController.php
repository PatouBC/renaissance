<?php

namespace App\ApiController;

use App\Entity\Indication;
use App\Form\IndicationType;
use App\Repository\IndicationRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Rest\Route(
 *     path="/indication",
 *     host="api.renaissance-terrehappy.fr")
 */
class IndicationController extends AbstractFOSRestController
{
    /**
     * Retrieves a collection of Category resource
     * @Rest\Get(path="/", name="indicationlist_api")
     * @Rest\View()
     */
    public function index(IndicationRepository $indicationRepository): View
    {
        $indications = $indicationRepository->findAll();
        return View::create($indications, Response::HTTP_OK);
    }
    /**
     * @Rest\Get(
     *     path="/{id}",
     *     name="indicationshow_api")
     */
    public function show(Indication $indication): View
    {
        return View::create($indication,  Response::HTTP_OK);
    }

    /**
     * @Rest\Post(
     *     path="/new",
     *     name="indicationcreate_api")
     */
    public function create(Request $request): View
    {
        $indication = new Indication();
        $indication->setDescription($request->get('description'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($indication);
        $em->flush();
        return View::create($indication,Response::HTTP_CREATED);
    }
    /**
     * @Rest\Delete(
     *     path="/{id}",
     *     name="indicationdelete_api"
     * )
     */
    public function delete(Indication $indication): View
    {
        if($indication)
        {
            $em=$this->getDoctrine()->getManager();
            $em->remove($indication);
            $em->flush();
        }
        return View::create([], Response::HTTP_NO_CONTENT);
    }
    /**
     * @Rest\Put(
     *     path="/{id}",
     *     name="indicationedit_api"
     * )
     */
    public function edit(Request $request, Indication $indication)
    {
        if($indication){
            $indication->setDescription($request->get('description'));
            $em=$this->getDoctrine()->getManager();
            $em->persist($indication);
            $em->flush();
        }
        return View::create($indication, Response::HTTP_OK);
    }
    /**
     * @Rest\Patch(
     *     path="/{id}",
     *     name="indicationpatch_api"
     * )
     */
    public function patch(Request $request, Indication $indication)
    {
        if($indication){
            $form = $this->createForm(IndicationType::class, $indication);
            $form->submit($request->request->all(), false);
            $em = $this->getDoctrine()->getManager();
            $em->persist($indication);
            $em->flush();
        }
        return View::create($indication, Response::HTTP_OK);
    }
}