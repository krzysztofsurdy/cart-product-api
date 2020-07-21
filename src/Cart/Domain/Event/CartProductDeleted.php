<?php
declare(strict_types=1);

namespace App\Cart\Domain\Event;

use App\SharedKernel\Event\CartEvent;

final class CartProductDeleted extends CartEvent
{
    private const LABEL_PRODUCT_ID = 'product_id';

    public static function createFor(string $cartId, string $productId): CartProductDeleted
    {
        return new self($cartId, [
            self::LABEL_PRODUCT_ID => $productId
        ]);
    }

    public function getProductId(): string
    {
        return $this->payload[self::LABEL_PRODUCT_ID];
    }
}
