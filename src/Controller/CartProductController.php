<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/v1/cart/product")
 */
class CartProductController extends CoreController
{
    /**
     * @Route("/", methods={"POST"}, name="cart_product_add")
     */
    public function addCartAction(Request $request): Response
    {
    }

    /**
     * @Route("/", methods={"DELETE"}, name="cart_product_delete")
     */
    public function addCartAction(Request $request): Response
    {
    }
}
