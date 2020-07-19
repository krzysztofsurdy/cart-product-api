<?php

declare(strict_types=1);

namespace App\Domain\Event;

use App\SharedKernel\Event\ProductEvent;

class ProductPriceChanged extends ProductEvent
{
    private const LABEL_PRICE = 'price';

    public static function createFor(string $productId, float $value): ProductPriceChanged
    {
        return new self($productId, [
            self::LABEL_PRICE => $value,
        ]);
    }

    public function getPrice(): float
    {
        return $this->payload[self::LABEL_PRICE];
    }
}
