<?php

declare(strict_types=1);

namespace App\Domain;

use App\Domain\Factory\ProductPriceFactory;

class ProductPrice implements \JsonSerializable
{
    use ProductPriceFactory;

    private ProductPriceCurrency $currency;
    private float $value;

    public function getCurrency(): ProductPriceCurrency
    {
        return $this->currency;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function jsonSerialize()
    {
        return [
            'value' => $this->value,
            'currency' => $this->currency->jsonSerialize(),
        ];
    }
}
