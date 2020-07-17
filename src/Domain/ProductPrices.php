<?php
declare(strict_types=1);

namespace App\Domain;

class ProductPrices implements \JsonSerializable
{
    /** @var ProductPrice[] */
    private array $prices;

    public function __construct($prices)
    {
        $this->prices = $prices;
    }

    public function add(ProductPrice $price): void
    {
        $this->prices[$price->getCurrency()->getId()] = $price;
    }

    public function jsonSerialize()
    {
        $jsonSerializable = [];

        foreach ($this->prices as $price) {
            $jsonSerializable[] = [
                'currencyId' => $price->getCurrency()->getId(),
                'currencyName' => $price->getCurrency()->getName(),
                'value' => $price->getValue()
            ];
        }

        return $jsonSerializable;
    }
}
