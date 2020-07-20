<?php
declare(strict_types=1);

namespace App\Product\Application\QueryHandler;

use App\Product\Application\Query\GetProductQuery;
use App\Product\Domain\Product;
use App\Product\Infrastructure\Exception\ProductNotFoundException;
use App\Product\Infrastructure\ProductRepositoryInterface;

class GetProductQueryHandler
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function __invoke(GetProductQuery $query): Product
    {
        $product = $this->productRepository->get($query->getId());

        if ($product) {
            return $product;
        }

        throw new ProductNotFoundException($query->getId());
    }
}
