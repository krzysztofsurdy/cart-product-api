<?php
declare(strict_types=1);

namespace App\Cart\Domain\Event;

use App\Product\Domain\ProductData;
use App\SharedKernel\Event\CartEvent;

class CartProductAdded extends CartEvent
{
    private const LABEL_PRODUCT_DATA = 'product_data';

    public static function createFor(string $cartId, ProductData $productData): CartProductAdded
    {
        return new self($cartId, [
            self::LABEL_PRODUCT_DATA => $productData->serialize()
        ]);
    }

    public function getProductData(): ProductData
    {
        return ProductData::createFromArray($this->payload[self::LABEL_PRODUCT_DATA]);
    }
}
