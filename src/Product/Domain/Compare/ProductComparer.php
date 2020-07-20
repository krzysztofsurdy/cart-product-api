<?php

declare(strict_types=1);

namespace App\Product\Domain\Compare;

use App\Product\Domain\Product;
use App\Product\Domain\ProductData;
use App\SharedKernel\Aggregate\AggregateRootDataInterface;
use App\SharedKernel\Compare\ComparerInterface;

final class ProductComparer implements ComparerInterface
{
    private Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * @param ProductData $aggregateRootData
     */
    public function compare(AggregateRootDataInterface $aggregateRootData): void
    {
        if ($aggregateRootData->getName() && $this->product->getName() !== $aggregateRootData->getName()) {
            $this->product->changeName($aggregateRootData->getName());
        }

        if ($aggregateRootData->getPrice() && $this->product->getPrice() !== $aggregateRootData->getPrice()) {
            $this->product->changePrice($aggregateRootData->getPrice());
        }
    }
}
