<?php

declare(strict_types=1);

namespace App\SharedKernel\Factory;

use App\Domain\Exception\FieldNotFoundException;
use App\SharedKernel\DataDeserializer\FloorToCamelCase;

trait FromArrayFactory
{
    public static function create(object $object, array $data): object
    {
        foreach ($data as $key => $value) {
            $key = FloorToCamelCase::serialize($key);

            if (empty($value)) {
                $value = null;
            }

            if (!property_exists(self::class, $key)) {
                throw new FieldNotFoundException(self::class, $key);
            }

            $object->{$key} = $value;
        }

        return $object;
    }

    public function serialize(): array
    {
        return get_object_vars($this);
    }
}
