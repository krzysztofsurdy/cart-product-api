<?php

declare(strict_types=1);

namespace App\Domain;

use App\Domain\Factory\ProductDataFactory;

class ProductData
{
    use ProductDataFactory;

    private ?string $name = null;
    private ?float $price = null;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }
}
