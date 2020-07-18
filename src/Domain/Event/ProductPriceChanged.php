<?php

declare(strict_types=1);

namespace App\Domain\Event;

use App\Domain\ProductPrice;
use App\SharedKernel\Event\ProductEvent;

class ProductPriceChanged extends ProductEvent
{
    private const LABEL_PRODUCT_PRICE = 'product_price';

    public static function createFor(string $productId, ProductPrice $price)
    {
        return new self($productId, [
            self::LABEL_PRODUCT_PRICE => $price->jsonSerialize(),
        ]);
    }

    public function getProductPrice(): ProductPrice
    {
        return ProductPrice::createFromArray($this->payload[self::LABEL_PRODUCT_PRICE]);
    }
}
