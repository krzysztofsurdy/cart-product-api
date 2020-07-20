<?php

declare(strict_types=1);

namespace App\Product\Infrastructure;

use App\Product\Domain\Product;

interface ProductRepositoryInterface
{
    public function get(string $id): Product;
    public function save(Product $product): void;
}
