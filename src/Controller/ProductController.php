<?php

declare(strict_types=1);

namespace App\Controller;

use App\Application\DTO\ProductAddRequestDTO;
use App\Application\DTO\ProductDeleteRequestDTO;
use App\Application\DTO\ProductGetRequestDTO;
use App\Application\DTO\ProductUpdateRequestDTO;
use App\Application\Service\ProductService;
use App\SharedKernel\Response\SuccessResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @Route("/product/{id}", methods={"GET"}, name="product_get")
     */
    public function getProductAction(Request $request): Response
    {
        $payload = ProductGetRequestDTO::createFromArray($request->query->all());
        $product = $this->productService->get($payload);

        return new SuccessResponse($product->jsonSerialize());
    }

    /**
     * @Route("/product", methods={"POST"}, name="product_add")
     */
    public function addProductAction(Request $request): Response
    {
        $payload = json_decode($request->getContent(), true);
        $payload = ProductAddRequestDTO::createFromArray($payload);

        $this->productService->add($payload);

        return new SuccessResponse();
    }

    /**
     * @Route("/product/{id}", methods={"DELETE"}, name="product_delete")
     */
    public function deleteProductAction(Request $request): Response
    {
        $payload = ProductDeleteRequestDTO::createFromArray($request->query->all());
        $this->productService->delete($payload);

        return new SuccessResponse();
    }

    /**
     * @Route("/product", methods={"PUT"}, name="product_update")
     */
    public function updateProductAction(Request $request): Response
    {
        $payload = json_decode($request->getContent(), true);
        $payload = ProductUpdateRequestDTO::createFromArray($payload);
        $this->productService->update($payload);

        return new SuccessResponse();
    }
}
