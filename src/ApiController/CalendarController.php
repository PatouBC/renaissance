<?php

namespace App\ApiController;

use App\Entity\DayPartStatus;
use App\Event\RdvDemandeEvent;
use App\Repository\DayPartRepository;
use App\Repository\DayPartStatusRepository;
use App\Repository\TypeconsultRepository;
use App\Repository\UserRepository;
use App\Repository\WorkingDayRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use FOS\UserBundle\Doctrine\UserManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * @Rest\Route("/calendar", host="api.renaissance-terrehappy.fr")
 */
class CalendarController extends AbstractFOSRestController
{
    protected $dispatcher;
    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * Retrieves a collection of Task resource
     * @Rest\Get(
     *     path = "/",
     *     name = "calendar_api"
     * )
     * @Rest\View()
     */
    public function index(WorkingDayRepository $workingDayRepository): View
    {
        $results = $workingDayRepository->findAll();
        // In case our GET was a success we need to return a 200 HTTP OK
        // response with the collection of workingdays object
        $workingDays = [];
        foreach ($results as $workingDay) {
            array_push($workingDays, $this->normalize($workingDay));
        }
        return View::create($workingDays, Response::HTTP_OK);
    }

    /**
     * Retrieves a collection of Task resource
     * @Rest\Put(
     *     path = "/addrdv",
     *     name = "calendar_addrdv_api"
     * )
     * @Rest\View()
     */
    public function addRdv(Request $request,
                           DayPartRepository $dayPartRepository,
                           DayPartStatusRepository $dayPartStatusRepository,
                           UserRepository $userRepository,
                           TypeconsultRepository $typeconsultRepository): View
    {
        $dayPart = $dayPartRepository->find($request->get('daypart'));
        $userRequest = $userRepository->find($request->get('user'));
        $consultrequest = $typeconsultRepository->find($request->get('consult'));

        if ($dayPart && $userRequest && $consultrequest) {
            if ($userRequest->getId() === $this->getUser()->getId()) {
                $statusPending = $dayPartStatusRepository->findOneBy(array("value" => DayPartStatus::PENDING));
                $em = $this->getDoctrine()->getManager();
                $dayPart->setUser($userRequest);
                $dayPart->setStatus($statusPending);
                $dayPart->setConsult($consultrequest);

                $rdvEvent = new RdvDemandeEvent($dayPart, $this->getUser());
                $this->dispatcher->dispatch('rdvDemande', $rdvEvent);
                $em->persist($dayPart);
                $em->flush();

                return View::create($dayPart, Response::HTTP_OK);
            }
        }
    }


    private function normalize($object)
    {
        /* Serializer, normalizer exemple */

        $serializer = new Serializer([new ObjectNormalizer()]);
        $object = $serializer->normalize($object, null,
            ['attributes' => [
                'id',
                'daydate',
                'daymonth',
                'dayyear',
                'dayparts' => [
                    'id',
                    'status' => [
                        'id',
                        'value',
                        'status'
                    ],
                    'type' => [
                        'id',
                        'value',
                        'definition'
                    ],
                    'user' => [
                        'id'
                    ],
                    'consult' => [
                        'id',
                        'description'
                    ]
                ]
            ]]);
        return $object;
    }
}
