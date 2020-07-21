<?php
declare(strict_types=1);

namespace App\Cart\Domain\Event;

use App\SharedKernel\Event\CartEvent;

final class CartCreated extends CartEvent
{
    public static function createFor(string $cartId): CartCreated
    {
        return new self($cartId, []);
    }

    public function getId(): string
    {
        return $this->aggregateId();
    }
}
