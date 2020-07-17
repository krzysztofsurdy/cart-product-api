<?php

declare(strict_types=1);

namespace App\Domain\Event;

use App\Domain\ProductPrice;
use App\SharedKernel\Event\ProductEvent;

class ProductPriceChanged extends ProductEvent
{
    public static function createFor(string $productId, ProductPrice $price)
    {
        return new self($productId, [
            'product_price' => $price->jsonSerialize(),
        ]);
    }

    public function getProductPrice(): ProductPrice
    {
        return ProductPrice::createFromArray($this->payload['product_price']);
    }
}
