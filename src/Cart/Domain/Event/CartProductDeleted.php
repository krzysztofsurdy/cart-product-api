<?php
declare(strict_types=1);

namespace App\Cart\Domain\Event;

use App\SharedKernel\Event\CartEvent;

class CartProductDeleted extends CartEvent
{
    public static function createFor(string $cartId, string $productId): CartProductDeleted
    {
        return new self($cartId, [
            'product_id' => $productId
        ]);
    }

    public function getProductId(): string
    {
        return $this->payload['product_id'];
    }
}
