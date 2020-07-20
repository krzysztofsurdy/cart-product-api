<?php

declare(strict_types=1);

namespace App\Product\Domain;

use App\Product\Domain\Factory\ProductDataFactory;
use App\SharedKernel\Aggregate\AggregateRootDataInterface;

final class ProductData implements AggregateRootDataInterface
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
