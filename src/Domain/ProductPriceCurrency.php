<?php

declare(strict_types=1);

namespace App\Domain;

use App\Domain\Factory\ProductPriceFactory;

class ProductPriceCurrency implements \JsonSerializable
{
    use ProductPriceFactory;

    private int $id;
    private string $name;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
