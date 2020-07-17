<?php

declare(strict_types=1);

namespace App\Domain\Factory;

use App\Domain\Exception\FieldNotFoundException;
use App\Domain\ProductPrice;
use App\Domain\ProductPriceCurrency;

trait ProductPriceFactory
{
    public static function createFromArray(array $data): ProductPrice
    {
        $productPrice = new ProductPrice();

        foreach ($data as $key => $value) {
            if (empty($value) && 0 !== $value) {
                $value = null;
            }

            if (!property_exists(self::class, $key)) {
                throw new FieldNotFoundException(ProductPrice::class, $key);
            }

            if ('currency' === $key) {
                $productPrice->{$key} = ProductPriceCurrency::createFromArray($value);
            } else {
                $productPrice->{$key} = $value;
            }
        }

        return $productPrice;
    }

    public function serialize(): array
    {
        return get_object_vars($this);
    }
}
