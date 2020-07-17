<?php

declare(strict_types=1);

namespace App\Domain;

use App\Domain\Exception\ProductPriceAlreadyExistsException;
use App\Domain\Exception\ProductPriceNotFoundException;

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
        if ($this->isPriceExist($price->getCurrency())) {
            throw new ProductPriceAlreadyExistsException($price->getCurrency()->getName());
        }

        $this->prices[$price->getCurrency()->getId()] = $price;
    }

    public function update(ProductPrice $price): void
    {
        if (!$this->isPriceExist($price->getCurrency())) {
            throw new ProductPriceNotFoundException($price->getCurrency()->getName());
        }

        $this->prices[$price->getCurrency()->getId()] = $price;
    }

    public function getByCurrency(ProductPriceCurrency $currency): ProductPrice
    {
        if (!$this->isPriceExist($currency)) {
            throw new ProductPriceNotFoundException($currency->getName());
        }

        return $this->prices[$currency->getId()];
    }

    public function jsonSerialize()
    {
        $jsonSerializable = [];

        foreach ($this->prices as $price) {
            $jsonSerializable[] = [
                'currencyId' => $price->getCurrency()->getId(),
                'currencyName' => $price->getCurrency()->getName(),
                'value' => $price->getValue(),
            ];
        }

        return $jsonSerializable;
    }

    private function isPriceExist(ProductPriceCurrency $currency): bool
    {
        if (!isset($this->prices[$currency->getId()])) {
            return false;
        }

        return true;
    }
}
