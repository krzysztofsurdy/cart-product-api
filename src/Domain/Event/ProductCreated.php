<?php

declare(strict_types=1);

namespace App\Domain\Event;

use App\Domain\ProductData;
use App\SharedKernel\Event\ProductEvent;

class ProductCreated extends ProductEvent
{
    private const LABEL_PRODUCT_DATA = 'product_data';

    public static function createFor(string $productId, ProductData $productData): ProductCreated
    {
        return new self($productId, [
            self::LABEL_PRODUCT_DATA => $productData->serialize(),
        ]);
    }

    public function getProductData(): ProductData
    {
        return ProductData::createFromArray($this->payload[self::LABEL_PRODUCT_DATA]);
    }
}
