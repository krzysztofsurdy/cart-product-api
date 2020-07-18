<?php

declare(strict_types=1);

namespace App\Application\Command;

use App\Domain\ProductPrice;

final class AddProductCommand
{
    private string $name;
    /** @var ProductPrice[] */
    private array $prices;

    /**
     * @param ProductPrice[] $prices
     */
    public function __construct(string $name, array $prices)
    {
        $this->name = $name;
        $this->prices = $prices;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrices(): array
    {
        return $this->prices;
    }
}
