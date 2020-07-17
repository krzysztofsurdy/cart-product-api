<?php

declare(strict_types=1);

namespace App\Domain\Factory;

use App\Domain\Exception\FieldNotFoundException;
use App\Domain\ProductPriceCurrency;

class ProductPriceCurrencyFactory
{
    public static function createFromArray(array $data): ProductPriceCurrency
    {
        $productPriceCurrency = new ProductPriceCurrency();

        foreach ($data as $key => $value) {
            if (empty($value) && 0 !== $value) {
                $value = null;
            }

            if (!property_exists(self::class, $key)) {
                throw new FieldNotFoundException(ProductPriceCurrency::class, $key);
            }

            $productPriceCurrency->{$key} = $value;
        }

        return  $productPriceCurrency;
    }

    public function serialize(): array
    {
        return get_object_vars($this);
    }
}
