<?php

declare(strict_types=1);

namespace App\Infrastructure\Products;

use App\Domain\Product;
use App\Infrastructure\Exception\ProductNotFound;
use App\Infrastructure\Products;

class InMemory implements Products
{
    private array $memory = [];

    public function get(string $id): Product
    {
        if (!isset($this->memory[$id])) {
            throw new ProductNotFound($id);
        }

        return $this->memory[$id];
    }

    public function save(Product $product): void
    {
        $this->memory[$product->getId()] = $product;
    }
}
