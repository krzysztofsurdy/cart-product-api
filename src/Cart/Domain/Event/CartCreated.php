<?php
declare(strict_types=1);

namespace App\Domain\Event;

use App\SharedKernel\Event\CartEvent;

class CartCreated extends CartEvent
{
    public static function createFor(string $id): CartCreated
    {
        return new self($id, []);
    }
}
