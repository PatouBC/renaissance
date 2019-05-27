<?php

namespace App\Controller;

use App\Entity\User;

use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user", host="admin.renaissance-terrehappy.fr")
 */
class UserController extends AbstractController
{

    /**
     * @Route("/", name="user_index", methods={"GET"})
     */
    public function index(UserManagerInterface $userManager): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userManager->findUsers(),
            'mainNavUser' => true,
        ]);
    }

    /**
     * @Route("/new", name="new_user", methods={"GET", "POST"})
     */
    public function createUser(UserManagerInterface $userManager): Response
    {
        $user = $userManager->createUser();
    }
}