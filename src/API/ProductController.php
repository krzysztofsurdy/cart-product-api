<?php
declare(strict_types=1);

namespace App\API;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product/{id}", methods={"GET"}, name="product_get")
     * @return Response
     */
    public function getProductAction(Request $request)
    {
        // TODO IMPLEMENT
    }

    /**
     * @Route("/product", methods={"POST"}, name="product_add")
     * @return Response
     */
    public function addProductAction(Request $request)
    {
        // TODO IMPLEMENT
    }

    /**
     * @Route("/product/{id}", methods={"DELETE"}, name="product_delete")
     * @return Response
     */
    public function deleteProductAction(Request $request)
    {
        // TODO IMPLEMENT
    }

    /**
     * @Route("/product", methods={"PUT"}, name="product_update")
     * @return Response
     */
    public function updateProductAction(Request $request)
    {
        // TODO IMPLEMENT
    }
}
