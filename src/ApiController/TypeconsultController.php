<?php

namespace App\ApiController;


use App\Entity\Typeconsult;
use App\Repository\TypeconsultRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Rest\Route(
 *     path="/typeconsult",
 *     host="api.renaissance-terrehappy.fr")
 */
class TypeconsultController extends AbstractFOSRestController
{


    /**
     * Retrieves a collection of typeconsult resource
     * @Rest\Get(path="/", name="consultlist_api")
     * @Rest\View()
     */
    public function index(TypeconsultRepository $typeconsultRepository): View
    {
        $consults = $typeconsultRepository->findAll();
        return View::create($consults, Response::HTTP_OK);
    }
    /**
     * @Rest\Get(
     *     path="/{id}",
     *     name="consultshow_api")
     */
    public function show(Typeconsult $typeconsult): View
    {
        return View::create($typeconsult,  Response::HTTP_OK);
    }


}