<?php
declare(strict_types=1);

namespace App\Domain;

class ProductData
{
    use ProductDataFactory;

    private ?string $name;
    private ?ProductPrices $prices;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getPrices(): ?ProductPrices
    {
        return $this->prices;
    }
}
