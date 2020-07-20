<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\ProductRepository;

use App\Product\Domain\Product;
use App\Product\Infrastructure\Exception\ProductNotFoundException;
use App\Product\Infrastructure\ProductRepositoryInterface;

final class InMemory implements ProductRepositoryInterface
{
    private array $memory = [];

    public function get(string $id): Product
    {
        if (!isset($this->memory[$id])) {
            throw new ProductNotFoundException($id);
        }

        return $this->memory[$id];
    }

    public function save(Product $product): void
    {
        $this->memory[$product->getId()] = $product;
    }
}
