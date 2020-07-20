<?php
declare(strict_types=1);

namespace App\Controller;

use App\Cart\Application\Service\CartService;
use App\Product\Application\DTO\ProductAddRequestDTO;
use App\Product\Application\DTO\ProductDeleteRequestDTO;
use App\Product\Application\DTO\ProductGetRequestDTO;
use App\Product\Application\DTO\ProductUpdateRequestDTO;
use App\Product\Application\Service\ProductService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/v1/cart")
 */
final class CartController extends CoreController
{
    private CartService $cartService;

    /**
     * @Route("/", methods={"GET"}, name="cart_get")
     */
    public function getCartAction(Request $request): Response
    {
    }

    /**
     * @Route("/", methods={"POST"}, name="cart_create")
     */
    public function createCartAction(): Response
    {
        try {
            $content = $request->getContent();
            $payload = json_decode(is_string($content) ? $content : '', true);
            $payload = ProductAddRequestDTO::createFromArray($payload);

            $this->productService->add($payload);


            return self::createSuccessApiResponse(
                ,
                JsonResponse::HTTP_OK
            );
        } catch (\Throwable $exception) {
            return self::createFailApiResponse($exception);
        }
    }
}
