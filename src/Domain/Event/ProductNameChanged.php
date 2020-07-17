<?php
declare(strict_types=1);

namespace App\Domain\Event;

use App\SharedKernel\Event\ProductEvent;

class ProductNameChanged extends ProductEvent
{
    public static function createFor(string $id, string $name) {
        return new self($id,[
           'name' => $name
        ]);
    }

    public function getName(): string
    {
        return $this->payload['name'];
    }
}
