<?php

namespace App\ApiController;

use App\Repository\DayPartRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;


/**
 * @Rest\Route(
 *     path="/daypart",
 *     host="api.renaissance-terrehappyfr" )
 */
class DayPartController extends AbstractFOSRestController
{
    /**
     * retrieves a collection of dayPart resource
     * @Rest\Get(path="/", name="daypartlist_api")
     * @Rest\View()
     */
    public function index(Request $request, DayPartRepository $dayPartRepository): View
    {
        $userId = $request->get('user');
        $results = $dayPartRepository->findBy(array('user' => $userId));
        $dayparts = [];
        foreach ($results as $dayPart) {
            array_push( $dayparts, $this->normalize($dayPart) );
        }
        return View::create($dayparts, Response::HTTP_OK);
    }

    private function normalize($object)
    {
        $serializer = new Serializer([new ObjectNormalizer()]);
        $object = $serializer->normalize($object, null,
            ['attributes' => [
                'id',
                'workingDay' =>[
                    'daydate',
                    'daymonth',
                    'dayyear'
                ],
                'type' => [
                    'id',
                    'value',
                    'definition'
                ],
                'consult' => [
                    'id',
                    'description'
                ],
                'status' => [
                    'id',
                    'value'
                ]
                ]
            ]);
        return $object;
    }
}