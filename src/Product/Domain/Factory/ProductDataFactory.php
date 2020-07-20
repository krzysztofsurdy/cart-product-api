<?php

declare(strict_types=1);

namespace App\Product\Domain\Factory;

use App\Product\Domain\ProductData;
use App\SharedKernel\Factory\FromArrayFactory;

trait ProductDataFactory
{
    use FromArrayFactory;

    public static function createFromArray(array $data): ProductData
    {
        $productData = new ProductData();

        /** @var ProductData $productData */
        $productData = self::create($productData, $data);

        return $productData;
    }
}
