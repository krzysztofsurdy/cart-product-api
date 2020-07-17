<?php
declare(strict_types=1);

namespace App\Domain;

class ProductPrice
{
    private ProductPriceCurrency $currency;
    private float $value;

    public function __construct(ProductPriceCurrency $currency, float $value)
    {
        $this->currency = $currency;
        $this->value = $value;
    }

    public function getCurrency(): ProductPriceCurrency
    {
        return $this->currency;
    }

    public function getValue(): float
    {
        return $this->value;
    }
}
