<?php

declare(strict_types=1);

namespace App\Domain\Event;

use App\Domain\ProductData;
use App\SharedKernel\Event\ProductEvent;

class ProductCreated extends ProductEvent
{
    public static function createFor(string $productId, ProductData $productData)
    {
        return new self($productId, [
            'product_data' => $productData->serialize(),
        ]);
    }

    public function getProductData(): ProductData
    {
        return ProductData::createFromArray($this->payload['product_data']);
    }
}
