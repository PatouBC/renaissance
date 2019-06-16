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
    public function index(Request $request, ProductRepository $productRepository): View
    {
        $categoryId = $request->get('category');
        if (!empty($categoryId)) {
            $products = $productRepository->findBy(array("category" => $categoryId));
        } else {
            $products = $productRepository->findAll();
        }

        return View::create($products, Response::HTTP_OK);
    }

}