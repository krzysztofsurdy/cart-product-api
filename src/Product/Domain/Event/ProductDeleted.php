<?php

declare(strict_types=1);

namespace App\Product\Domain\Event;

use App\SharedKernel\Event\ProductEvent;

final class ProductDeleted extends ProductEvent
{
    public static function createFor(string $productId): ProductDeleted
    {
        return new self($productId, []);
    }
}
