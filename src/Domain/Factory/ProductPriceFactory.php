<?php

declare(strict_types=1);

namespace App\Domain\Factory;

use App\Domain\ProductPrice;
use App\Domain\ProductPriceCurrency;
use App\SharedKernel\Factory\FromArrayFactory;

trait ProductPriceFactory
{
    use FromArrayFactory;

    public static function createFromArray(array $data): ProductPrice
    {
        $productPrice = new ProductPrice();

        /** @var ProductPrice $productPrice */
        $productPrice = self::create($productPrice, $data);

        if (isset($data['currency'])) {
            $productPrice->{'currency'} = ProductPriceCurrency::createFromArray($data['currency']);
        }

        return $productPrice;
    }
}
