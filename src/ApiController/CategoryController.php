<?php

namespace App\ApiController;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Rest\Route(
 *     path="/category",
 *     host="api.renaissance-terrehappy.fr")
 */
class CategoryController extends AbstractFOSRestController
{
    /**
     * Retrieves a collection of Category resource
     * @Rest\Get(path="/", name="categorylist_api")
     * @Rest\View()
     */
    public function index(CategoryRepository $categoryRepository): View
    {
        $categories = $categoryRepository->findAll();
        return View::create($categories, Response::HTTP_OK);
    }
    /**
     * @Rest\Get(
     *     path="/{id}",
     *     name="categoryshow_api")
     */
    public function show(Category $category): View
    {
        return View::create($category,  Response::HTTP_OK);
    }

    /**
     * @Rest\Post(
     *     path="/new",
     *     name="categorycreate_api")
     */
    public function create(Request $request): View
    {
        $category = new Category();
        $category->setTitle($request->get('title'));
        $category->setDescription($request->get('description'));
        $category->setImage($request->get('image'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($category);
        $em->flush();
        return View::create($category,Response::HTTP_CREATED);
    }
    /**
     * @Rest\Delete(
     *     path="/{id}",
     *     name="categorydelete_api"
     * )
     */
    public function delete(Category $category): View
    {
        if($category)
        {
            $em=$this->getDoctrine()->getManager();
            $em->remove($category);
            $em->flush();
        }
        return View::create([], Response::HTTP_NO_CONTENT);
    }
    /**
     * @Rest\Put(
     *     path="/{id}",
     *     name="categoryedit_api"
     * )
     */
    public function edit(Request $request, Category $category)
    {
        if($category){
            $category->setTitle($request->get('title'));
            $category->setDescription($request->get('description'));
            $category->setImage($request->get('image'));
            $em=$this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();
        }
        return View::create($category, Response::HTTP_OK);
    }
    /**
     * @Rest\Patch(
     *     path="/{id}",
     *     name="categorypatch_api"
     * )
     */
    public function patch(Request $request, Category $category)
    {
        if($category){
            $form = $this->createForm(CategoryType::class, $category);
            $form->submit($request->request->all(), false);
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();
        }
        return View::create($category, Response::HTTP_OK);
    }
}