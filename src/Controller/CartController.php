<?php
declare(strict_types=1);

namespace App\Controller;

use App\Cart\Application\DTO\AddCartProductRequestDTO;
use App\Cart\Application\DTO\DeleteCartProductRequestDTO;
use App\Cart\Application\Service\CartService;
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
    private ProductService $productService;

    public function __construct(CartService $cartService, ProductService $productService)
    {
        $this->cartService = $cartService;
        $this->productService = $productService;
    }

    /**
     * @Route("/{id}", methods={"GET"}, name="cart_get")
     */
    public function getCartAction(string $id): Response
    {
        try {
            return self::createSuccessApiResponse(
                $this->cartService->get($id)->jsonSerialize(),
                JsonResponse::HTTP_OK
            );
        } catch (\Throwable $exception) {
            return self::createFailApiResponse($exception);
        }
    }

    /**
     * @Route("", methods={"POST"}, name="cart_create")
     */
    public function createCartAction(): Response
    {
        try {
            return self::createSuccessApiResponse(
                $this->cartService->create()->jsonSerialize(),
                JsonResponse::HTTP_OK
            );
        } catch (\Throwable $exception) {
            return self::createFailApiResponse($exception);
        }
    }

    /**
     * @Route("/product", methods={"POST"}, name="cart_product_add")
     */
    public function addCartProductAction(Request $request): Response
    {
        try {
            $content = $request->getContent();
            $payload = json_decode(is_string($content) ? $content : '', true);
            $product = $this->productService->specific($payload['product_id']);

            $payload = AddCartProductRequestDTO::createFromArray(
                array_merge(
                    $payload,
                    ['productData' => $product->getProductData()]
                )
            );

            $this->cartService->addProduct($payload);


            return self::createSuccessApiResponse(
                null,
                JsonResponse::HTTP_OK
            );
        } catch (\Throwable $exception) {
            return self::createFailApiResponse($exception);
        }
    }

    /**
     * @Route("/product", methods={"DELETE"}, name="cart_product_delete")
     */
    public function deleteCartProductAction(Request $request): Response
    {
        try {
            $content = $request->getContent();
            $payload = json_decode(is_string($content) ? $content : '', true);
            $payload = DeleteCartProductRequestDTO::createFromArray($payload);

            $this->cartService->deleteProduct($payload);

            return self::createSuccessApiResponse(
                null,
                JsonResponse::HTTP_OK
            );
        } catch (\Throwable $exception) {
            return self::createFailApiResponse($exception);
        }
    }
}
