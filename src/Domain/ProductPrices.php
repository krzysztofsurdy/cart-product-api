<?php

declare(strict_types=1);

namespace App\Domain;

use App\Domain\Exception\ProductPriceAlreadyExistsException;
use App\Domain\Exception\ProductPriceNotFoundException;
use JsonSerializable;

class ProductPrices implements JsonSerializable
{
    /** @var ProductPrice[] */
    private array $prices;

    /**
     * @param ProductPrice[] $prices
     */
    public function __construct(array $prices)
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
                ProductPriceCurrency::LABEL_ID => $price->getCurrency()->getId(),
                ProductPriceCurrency::LABEL_NAME => $price->getCurrency()->getName(),
                ProductPrice::LABEL_VALUE_ => $price->getValue(),
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
