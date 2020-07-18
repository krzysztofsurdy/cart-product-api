<?php

declare(strict_types=1);

namespace App\Domain\Compare;

use App\Domain\ComparerInterface;
use App\Domain\Product;
use App\Domain\ProductData;

class ProductComparer implements ComparerInterface
{
    private Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function compare(ProductData $productData): void
    {
        if ($productData->getName() && $this->product->getName() !== $productData->getName()) {
            $this->product->changeName($productData->getName());
        }

        if ($productData->getPrice() && $this->product->getPrice() !== $productData->getPrices()) {
            $this->product->changePrice($productData->getPrice());
        }
    }
}
