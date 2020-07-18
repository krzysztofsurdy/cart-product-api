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

class ProductController extends CoreController
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @Route("/product/{id}", methods={"GET"}, name="product_get")
     */
    public function getProductAction(string $id): Response
    {
        $payload = ProductGetRequestDTO::createFromArray(['id' => $id]);
        $product = $this->productService->get($payload);

        return $this->createApiResponse(
            true,
            $product->jsonSerialize(),
            JsonResponse::HTTP_OK
        );
    }

    /**
     * @Route("/product", methods={"GET"}, name="products_get")
     */
    public function getProductsAction(Request $request): Response
    {
        $product = $this->productService->get($payload);

        return $this->createApiResponse(
            true,
            $product->jsonSerialize(),
            JsonResponse::HTTP_OK
        );
    }

    /**
     * @Route("/product", methods={"POST"}, name="product_add")
     */
    public function addProductAction(Request $request): Response
    {
        $payload = json_decode($request->getContent(), true);
        $payload = ProductAddRequestDTO::createFromArray($payload);

        $this->productService->add($payload);

        return $this->createApiResponse(
            true,
            null,
            JsonResponse::HTTP_NO_CONTENT
        );
    }

    /**
     * @Route("/product/{id}", methods={"DELETE"}, name="product_delete")
     */
    public function deleteProductAction(string $id): Response
    {
        $payload = ProductDeleteRequestDTO::createFromArray(['id' => $id]);
        $this->productService->delete($payload);

        return $this->createApiResponse(
            true,
            null,
            JsonResponse::HTTP_NO_CONTENT
        );
    }

    /**
     * @Route("/product", methods={"PUT"}, name="product_update")
     */
    public function updateProductAction(Request $request): Response
    {
        $payload = json_decode($request->getContent(), true);
        $payload = ProductUpdateRequestDTO::createFromArray($payload);
        $this->productService->update($payload);

        return $this->createApiResponse(
            true,
            null,
            JsonResponse::HTTP_NO_CONTENT
        );
    }
}
