<?php

namespace App\ApiController;

use App\Repository\DayPartTypeRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * @Rest\Route(
 *     path="/dayparttype",
 *     host="api.renaissance-terrehappy.fr")
 */
class DayparttypeController extends AbstractFOSRestController
{
    /**
     * Retrieves a collection of Dayparttype resource
     * @Rest\Get(path="/", name="dayparttypelist_api")
     * @Rest\View()
     */
    public function index(DayPartTypeRepository $dayPartTypeRepository): View
    {
        $dayparttypes = $dayPartTypeRepository->findAll();
        return View::create($dayparttypes, Response::HTTP_OK);
    }
}