<?php

namespace App\ApiController;

use App\Entity\Timeslot;
use App\Repository\TimeslotRepository;
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
        $timeslots = $this->normalize($timeslots);
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
        $timeslot = $this->normalize($timeslot);
        return View::create($timeslot,  Response::HTTP_OK);
    }
    private function normalize($object)
    {
        $serializer = new Serializer([new ObjectNormalizer()]);
        $object = $serializer->normalize($object, null,
            ['attributes' => [
                    'id',
                    'slot',
                    'dispo',
                    'confirmed',
                    'user',
                    'typeconsult',
            ]]);
        return $object;
    }
}