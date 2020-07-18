<?php

declare(strict_types=1);

namespace App\Domain\Factory;

use App\Domain\ProductPriceCurrency;
use App\SharedKernel\Factory\FromArrayFactory;

trait ProductPriceCurrencyFactory
{
    use FromArrayFactory;

    public static function createFromArray(array $data): ProductPriceCurrency
    {
        $productPriceCurrency = new ProductPriceCurrency();

        /** @var ProductPriceCurrency $productPriceCurrency */
        $productPriceCurrency = self::create($productPriceCurrency, $data);

        return  $productPriceCurrency;
    }
}
