<?php
namespace App\ApiController;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Rest\Route(
 *     path="/product",
 *     host="api.renaissance-terrehappy.fr")
 */
class ProductController extends AbstractFOSRestController
{
    /**
     * Retrieves a collection of Product resource
     * @Rest\Get(
     *     path="/",
     *     name="productlist_api")
     * @Rest\View()
     */
    public function index(Request $request,ProductRepository $productRepository): View
    {
        $categoryId = $request->get('category');
        if (!empty($categoryId)) {
            $products=$productRepository->findBy(array("category"=>$categoryId));
        }else{
            $products=$productRepository->findAll();
        }

        return View::create($products, Response::HTTP_OK);
    }

    /**
     * @Rest\Get(
     *     path="/{id}",
     *     name="productshow_api")
     */
    public function show(Product $product): View
    {
        return View::create($product, Response::HTTP_OK);
    }
    /**
     * @Rest\Post(
     *     path="/new",
     *     name="productcreate_api")
     */
    public function create(Request $request): View
    {
        $product = new Product();
        $product->setName($request->get('name'));
        $product->setState($request->get('state'));
        $product->setEffect($request->get('effect'));
        $product->setCategory($request->get('category'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($product);
        $em->flush();

        return View::create($product, Response::HTTP_CREATED);
    }

    /**
     * @Rest\Delete(
     *     path="/{id}",
     *     name="product_api")
     */
    public function delete(Product $product): View
    {
        if($product)
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($product);
            $em->flush();
        }
        return View::create($product, Response::HTTP_NO_CONTENT);
    }
    /**
     * @Rest\Put(
     *     path="/{id}",
     *     name="productedit_api")
     */
    public function edit(Request $request, Product $product)
    {
        if($product){
            $product->setName($request->get('name'));
            $product->setState($request->get('state'));
            $product->setEffect($request->get('effect'));
            $product->setCategory($request->get('category'));
        }
        return View::create($product, Response::HTTP_OK);
    }
    /**
     * @Rest\Patch(
     *     path="/{id}",
     *     name="productpatch_api")
     */
    public function patch(Request $request, Product $product)
    {
        if($product){
            $form = $this->createForm(ProductType::class, $product);
            $form->submit($request->request->all(), false);
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();
        }
        return View::create($product, Response::HTTP_OK);
    }
}