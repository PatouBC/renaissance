<?php
namespace App\ApiController;

use App\Entity\Email;
use App\Form\EmailType;
use App\Repository\EmailRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Rest\Route(
 *     path="/email",
 *     host="api.renaissance-terrehappy.fr")
 */
class EmailController extends AbstractFOSRestController
{
    /**
     * Retrieves a collection of Email resource
     * @Rest\Get(
     *     path="/",
     *     name="emaillist_api")
     * @Rest\View()
     */
    public function index(Request $request, EmailRepository $emailRepository): View
    {
        $userId = $request->get('user');
        if(!empty($userId)) {
            $emails = $emailRepository->findBy(array("user" => $userId));
        }else{
            $emails = $emailRepository->findAll();
        }
        return View::create($emails, Response::HTTP_OK);
    }

    /**
     * @Rest\Get(
     *     path="/{id}",
     *     name="emailshow_apli")
     */
    public function show(Email $email) : View
    {
        return View::create($email, Response::HTTP_OK);
    }

    /**
     * @Rest\Post(
     *     path="/new",
     *     name="emailcreate_api")
     */
    public function create(Request $request): View
    {
        $email = new Email();
        $email->setName($request->get('name'));
        $email->setFirstname($request->get('firstname'));
        $email->setAddress($request->get('address'));
        $email->setObject($request->get('object'));
        $email->setMessage($request->get('message'));
        $email->setRgpd(true);
        $email->setTreated(false);
        $email->setUser($this->getUser());

        $em = $this->getDoctrine()->getManager();
        $em->persist($email);
        $em->flush();

        return View::create($email, Response::HTTP_CREATED);
    }

    /**
     * @Rest\Delete(
     *     path="/{id}",
     *     name="email_api")
     */
    public function delete(Email $email): View
    {
        if($email)
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($email);
            $em->flush();
        }
        return View::create($email, Response::HTTP_NO_CONTENT);
    }

    /**
     * @Rest\Put(
     *     path="/{id}",
     *     name="emailedit_api")
     */
    public function edit(Request $request, Email $email)
    {
        if($email){
            $em = $this->getDoctrine()->getManager();
            $email->setName($request->get('name'));
            $email->setFirstname($request->get('firstname'));
            $email->setAddress($request->get('address'));
            $email->setObject($request->get('object'));
            $email->setMessage($request->get('message'));
            $email->setUser($this->getUser());
            $em->persist($email);
            $em->flush();
        }
        return View::create($email, Response::HTTP_OK);
    }
    /**
     * @Rest\Patch(
     *     path="/{id}",
     *     name="emailpatch_api")
     */
    public function patch(Request $request, Email $email)
    {
        if($email){
            $form = $this->createForm(EmailType::class, $email);
            $form->submit($request->request->all(), false);
            $em = $this->getDoctrine()->getManager();
            $em->persist($email);
            $em->flush();
        }
        return View::create($email, Response::HTTP_OK);
    }
}
