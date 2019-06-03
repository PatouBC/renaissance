<?php

namespace App\ApiController;

use App\Entity\Timeslot;
use App\Repository\TimeslotRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Rest\Route(path="/timeslot", host="api.renaissance-terrehappy.fr")
 */
class TimeslotController extends AbstractFOSRestController
{
    /**
     * Retrieves a collection of Timeslot resource
     * @Rest\Get(path="/", name="timeslot_list_api")
     * @Rest\View()
     */
    public function index(TimeslotRepository $timeslotRepository): View
    {
        $timeslots = $timeslotRepository->findAll();
        return View::create($timeslots, Response::HTTP_OK);
    }

}