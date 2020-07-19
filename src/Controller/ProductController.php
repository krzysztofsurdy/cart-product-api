<?php

declare(strict_types=1);

namespace App\Controller;

use App\Application\DTO\ProductAddRequestDTO;
use App\Application\DTO\ProductDeleteRequestDTO;
use App\Application\DTO\ProductGetRequestDTO;
use App\Application\DTO\ProductUpdateRequestDTO;
use App\Application\Service\ProductService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ProductController extends CoreController
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @Route("/api/product", methods={"GET"}, name="products_get")
     */
    public function getProductsAction(Request $request): Response
    {
        try {
            $payload = ProductGetRequestDTO::createFromArray($request->query->all());
            $products = $this->productService->get($payload);

            return self::createSuccessApiResponse(
                $products->serialize(),
                JsonResponse::HTTP_OK
            );
        } catch (\Throwable $exception) {
            return self::createFailApiResponse($exception);
        }
    }

    /**
     * @Route("/api/product", methods={"POST"}, name="product_add")
     */
    public function addProductAction(Request $request): Response
    {
        try {
            $content = $request->getContent();
            $payload = json_decode(is_string($content) ? $content : '', true);
            $payload = ProductAddRequestDTO::createFromArray($payload);

            $this->productService->add($payload);


            return self::createSuccessApiResponse(
                null,
                JsonResponse::HTTP_OK
            );
        } catch (\Throwable $exception) {
            return self::createFailApiResponse($exception);
        }
    }

    /**
     * @Route("/api/product/{id}", methods={"DELETE"}, name="product_get")
     */
    public function deleteProductAction(string $id): Response
    {
        try {
            $payload = ProductDeleteRequestDTO::createFromArray(['id' => $id]);
            $this->productService->delete($payload);

            return self::createSuccessApiResponse(
                null,
                JsonResponse::HTTP_OK
            );
        } catch (\Throwable $exception) {
            return self::createFailApiResponse($exception);
        }
    }

    /**
     * @Route("/api/product", methods={"PUT"}, name="product_update")
     */
    public function updateProductAction(Request $request): Response
    {
        try {
            $content = $request->getContent();
            $payload = json_decode(is_string($content) ? $content : '', true);
            $payload = ProductUpdateRequestDTO::createFromArray($payload);
            $this->productService->update($payload);

            return self::createSuccessApiResponse(
                null,
                JsonResponse::HTTP_OK
            );
        } catch (\Throwable $exception) {
            return self::createFailApiResponse($exception);
        }
    }
}
