<?php

declare(strict_types=1);

namespace App\Domain;

use App\Domain\Factory\ProductDataFactory;

class ProductData
{
    use ProductDataFactory;

    private ?string $name;
    private ?float $price;
    private ?Currency $currency;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function getCurrency(): ?Currency
    {
        return $this->currency;
    }
}
