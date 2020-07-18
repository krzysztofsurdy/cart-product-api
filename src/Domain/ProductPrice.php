<?php

declare(strict_types=1);

namespace App\Domain;

use App\Domain\Factory\ProductPriceFactory;
use JsonSerializable;

class ProductPrice implements JsonSerializable
{
    use ProductPriceFactory;

    public const LABEL_VALUE_ = 'value';
    public const LABEL_CURRENCY = 'currency';
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
            self::LABEL_VALUE_ => $this->value,
            self::LABEL_CURRENCY => $this->currency->jsonSerialize(),
        ];
    }
}
