<?php

declare(strict_types=1);

namespace App\Domain\Factory;

use App\Domain\Exception\FieldNotFoundException;
use App\Domain\ProductData;

trait ProductDataFactory
{
    public static function createFromArray(array $data): ProductData
    {
        $productData = new ProductData();

        foreach ($data as $key => $value) {
            if (empty($value) && 0 !== $value) {
                $value = null;
            }

            if (!property_exists(self::class, $key)) {
                throw new FieldNotFoundException(self::class, $key);
            }

            $productData->{$key} = $value;
        }

        return $productData;
    }

    public function serialize(): array
    {
        return get_object_vars($this);
    }
}
