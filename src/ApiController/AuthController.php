<?php
namespace App\ApiController;

use App\Entity\User;
use App\Event\FilterUserRegistrationEvent;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\UserBundle\Model\UserManagerInterface;
use App\Repository\UserRepository;


/**
 * @Rest\Route("/auth", host="api.renaissance-terrehappy.fr")
 */
Class AuthController extends AbstractFOSRestController
{
        private $eventDispatcher;

        function __construct(EventDispatcherInterface $eventDispatcher)
        {
            $this->eventDispatcher = $eventDispatcher;
        }

    /**
     * @Rest\Post(
     *     path="/register",
     *     name="auth_register_api"
     * )
     * @param Request $request
     * @param UserManagerInterface $userManager
     * @return View
     */
    public function register(Request $request, UserManagerInterface $userManager)
    {
        $user = new User();
        $user
            ->setName($request->get('name'))
            ->setFirstname($request->get('firstname'))
            ->setUsername($request->get('username'))
            ->setPlainPassword($request->get('password'))
            ->setEmail($request->get('email'))
            ->setRgpd(true)
            ->setEnabled(false)
            ->setRoles(['ROLE_USER'])
            ->setSuperAdmin(false)
        ;
        try {
            $this->eventDispatcher->dispatch('user_registration.created',
                new FilterUserRegistrationEvent($user, $request));
            $userManager->updateUser($user);
        } catch (\Exception $e) {
            return View::create(["error" => $e->getMessage()], 500);
        }
        return View::create($user, Response::HTTP_CREATED);
    }

    /**
     * @Rest\Get(
     *     path="/profile",
     *     name="auth_profile_api")
     * @return View
     */
    public function profile()
    {
        $user = $this->getUser();
        return View::create($user, Response::HTTP_OK);
    }

    /**
     * @Rest\Put(
     *     path="/profile/edit",
     *     name="auth_edit_profile_api"
     * )
     * @param Request $request
     * @param UserManagerInterface $userManager
     * @return View
     */
    public function profileEdit(Request $request, UserManagerInterface $userManager, UserRepository $userRepository)
    {
        $user = $userRepository->find($this->getUser());
        $user->setName($request->get('name'));
        $user->setFirstname($request->get('firstname'));

        $userManager->updateUser($user);

        return View::create($user, Response::HTTP_OK);
    }


}