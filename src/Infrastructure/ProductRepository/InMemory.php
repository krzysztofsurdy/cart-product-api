<?php

declare(strict_types=1);

namespace App\Infrastructure\ProductRepository;

use App\Domain\Product;
use App\Infrastructure\Exception\ProductNotFoundException;
use App\Infrastructure\ProductRepositoryInterface;

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
