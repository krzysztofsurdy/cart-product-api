<?php

declare(strict_types=1);

namespace App\Product\Application\Command;

use App\Product\Domain\ProductData;

final class UpdateProductCommand
{
    private string $id;
    private ProductData $productData;

    public function __construct(string $id, ProductData $productData)
    {
        $this->id = $id;
        $this->productData = $productData;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getProductData(): ProductData
    {
        return $this->productData;
    }
}
