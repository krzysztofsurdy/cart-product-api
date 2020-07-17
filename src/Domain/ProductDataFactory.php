<?php
declare(strict_types=1);

namespace App\Domain;

use App\Domain\Exception\ProductDataFieldNotFound;

trait ProductDataFactory
{
    public static function createFromArray(array $data): ProductData
    {
        $productData = new ProductData();

        foreach ($data as $key => $value) {
            if(empty($value) && $value !== 0) {
                $value = null;
            }

            if (!property_exists(self::class, $key)) {
                throw new ProductDataFieldNotFound($key);
            }

            $productData->{$key} = $value;
        }
    }

    public function serialize(): array
    {
        return get_object_vars($this);
    }
}
