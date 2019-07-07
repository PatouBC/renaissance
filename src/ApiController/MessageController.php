<?php
namespace App\ApiController;

use App\Entity\Message;
use App\Event\MessageSentEvent;
use App\Form\MessageType;
use App\Repository\MessageRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
/**
 * @Rest\Route(
 *     path="/message",
 *     host="api.renaissance-terrehappy.fr")
 */
class MessageController extends AbstractFOSRestController
{
    protected $dispatcher;
    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }
    /**
     * Retrieves a collection of Message resource
     * @Rest\Get(
     *     path="/",
     *     name="messagelist_api")
     * @Rest\View()
     */
    public function index(Request $request, MessageRepository $messageRepository): View
    {
        $userId = $request->get('user');
        if(!empty($userId)) {
            $messages = $messageRepository->findBy(array("user" => $userId));
        }else{
            $messages = $messageRepository->findAll();
        }
        return View::create($messages, Response::HTTP_OK);
    }
    /**
     * @Rest\Get(
     *     path="/{id}",
     *     name="messageshow_apli")
     */
    public function show(Message $message) : View
    {
        return View::create($message, Response::HTTP_OK);
    }
    /**
     * @Rest\Post(
     *     path="/new",
     *     name="messagecreate_api")
     */
    public function create(Request $request): View
    {
        $message = new Message();
        $message->setName($request->get('name'));
        $message->setFirstname($request->get('firstname'));
        $message->setAddress($request->get('address'));
        $message->setObject($request->get('object'));
        $message->setMessage($request->get('message'));
        $message->setRgpd(true);
        $message->setTreated(false);
        $message->setUser($this->getUser());
        $em = $this->getDoctrine()->getManager();

        $messageEvent = new MessageSentEvent($message);
        $this->dispatcher->dispatch('messageSent', $messageEvent);
        $em->persist($message);
        $em->flush();
        return View::create($message, Response::HTTP_CREATED);
    }
    /**
     * @Rest\Delete(
     *     path="/{id}",
     *     name="message_api")
     */
    public function delete(Message $message): View
    {
        if($message)
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($message);
            $em->flush();
        }
        return View::create($message, Response::HTTP_NO_CONTENT);
    }
    /**
     * @Rest\Put(
     *     path="/{id}",
     *     name="messageedit_api")
     */
    public function edit(Request $request, Message $message)
    {
        if($message){
            $em = $this->getDoctrine()->getManager();
            $message->setName($request->get('name'));
            $message->setFirstname($request->get('firstname'));
            $message->setAddress($request->get('address'));
            $message->setObject($request->get('object'));
            $message->setMessage($request->get('message'));
            $message->setUser($this->getUser());
            $em->persist($message);
            $em->flush();
        }
        return View::create($message, Response::HTTP_OK);
    }
    /**
     * @Rest\Patch(
     *     path="/{id}",
     *     name="messagepatch_api")
     */
    public function patch(Request $request, Message $message)
    {
        if($message){
            $form = $this->createForm(MessageType::class, $message);
            $form->submit($request->request->all(), false);
            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();
        }
        return View::create($message, Response::HTTP_OK);
    }
}