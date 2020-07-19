<?php

declare(strict_types=1);

namespace App\Domain\Event;

use App\SharedKernel\Event\ProductEvent;

class ProductNameChanged extends ProductEvent
{
    private const LABEL_NAME = 'name';

    public static function createFor(string $id, string $name): ProductNameChanged
    {
        return new self($id, [
            self::LABEL_NAME => $name,
        ]);
    }

    public function getName(): string
    {
        return $this->payload[self::LABEL_NAME];
    }
}
