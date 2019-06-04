<?php

namespace App\ApiController;

use App\Entity\Timeslot;
use App\Repository\TimeslotRepository;
use App\Repository\WorkingdayRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

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

    /**
     * @Rest\Get(
     *     path="/{id}",
     *     name="timeslot_show_api"
     * )
     */
    public function show(Timeslot $timeslot): View
    {
        return View::create($timeslot,  Response::HTTP_OK);
    }

    /**
     * @Rest\Post(
     *     path="/new",
     *     name="timeslot_create_api")
     */
    public function create(Request $request): View
    {
        $timeslot = new Timeslot();
        $timeslot->setSlot($request->get('slot'));
        $timeslot->setDispo($request->get('dispo'));
        $timeslot->setConfirmed($request->get('confirmed'));
        $timeslot->setDescription($request->get('description'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($timeslot);
        $em->flush();

        return View::create($timeslot, Response::HTTP_CREATED);
    }

    /**
     * @Rest\Put(
     *     path="/{id}",
     *     name="timeslot_edit_api")
     */
    public function edit(Request $request, Timeslot $timeslot, WorkingdayRepository $workingdayRepository)
    {
        if($timeslot){
            $timeslot->setSlot($request->get('slot'));
            $timeslot->setDispo($request->get('dispo'));
            $timeslot->setConfirmed($request->get('confirmed'));
            $timeslot->setDescription($request->get('description'));
            $workingday = $workingdayRepository->find($request->get('workingday'));
            $timeslot->setWorkingday($workingday);

        }
        return View::create($timeslot, Response::HTTP_OK);
    }
}