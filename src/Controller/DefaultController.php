<?php
namespace App\Controller;

use App\Entity\Message;
use App\Repository\DayPartRepository;
use App\Repository\DayPartStatusRepository;
use App\Repository\MessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/", host="admin.renaissance-terrehappy.fr")
 */
class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(MessageRepository $messageRepository, DayPartRepository $dayPartRepository)
    {
        $messages = $messageRepository->findAll();
        $dayparts = $dayPartRepository->findAll();
        return $this->render('default/index.html.twig', [
            'messages' => $messages,
            'mainNavHome' => true,
            'count' => 0,
            'dayparts' => $dayparts,
            'count2' => 0
        ]);
    }

    /**
     * @Route("/redirectionTo", name="redirectTo")
     */
    public function redirection()
    {
        $user = $this->getUser();
        if($user->hasRole('ROLE_ADMIN'))
        {
            return $this->redirectToRoute('fos_user_profile_show');
        }

        return $this->redirectToRoute('to_ng');
    }
}