<?php

declare(strict_types=1);

namespace App\Domain\Compare;

use App\Domain\ComparerInterface;
use App\Domain\Product;
use App\Domain\ProductData;
use App\Domain\ProductPrice;

class ProductComparerInterface implements ComparerInterface
{
    private Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function compare(ProductData $productData): void
    {
        if (null !== $this->product->getName()) {
            $this->product->changeName($productData->getName());
        }

        if ($productData->getPrices()) {
            /** @var ProductPrice[] $prices */
            $prices = $productData->getPrices();

            foreach ($prices as $price) {
                $this->product->changePrice($price);
            }
        }
    }
}
