<?php

namespace App\ApiController;

use App\Entity\Workingday;
use App\Form\WorkingdayType;
use App\Repository\WorkingdayRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * @Rest\Route(
 *     path="/workingday",
 *     host="api.renaissance-terrehappy.fr")
 */
class WorkingdayController extends AbstractFOSRestController
{
    /**
     * Retrieves a collection of Workingday resource
     * @Rest\Get(
     *     path = "/",
     *     name = "workingday_list_api"
     * )
     * @Rest\View()
     */
    public function index(WorkingdayRepository $workingdayRepository): View
    {
        $workingdays = $workingdayRepository->findAll();
        return View::create($workingdays, Response::HTTP_OK);
    }

    /**
     * @Rest\Get(
     *     path="/{id}",
     *     name="workingday_show_api"
     * )
     */
    public function show(Workingday $workingday): View
    {
        return View::create($workingday,  Response::HTTP_OK);
    }


}