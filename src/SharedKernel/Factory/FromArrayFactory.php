<?php

declare(strict_types=1);

namespace App\SharedKernel\Factory;

use App\Domain\Exception\FieldNotFoundException;
use App\SharedKernel\DataDeserializer\FloorToCamelCase;

trait FromArrayFactory
{
    public static function create(object $object, array $data): object
    {
        $data = self::preparseTypes($data);

        foreach ($data as $key => $value) {
            $key = FloorToCamelCase::serialize($key);

            if (empty($value) && !is_array($value)) {
                $value = null;
            }

            if (!property_exists(self::class, $key)) {
                throw new FieldNotFoundException(self::class, $key);
            }

            $object->{$key} = $value;
        }

        return $object;
    }

    private static function preparseTypes(array $data): array
    {
        foreach ($data as $key => $value) {
            $dataTypeKey = sprintf('%s_type', $key);

            if (isset($data[$dataTypeKey])) {
                settype($value, $data[$dataTypeKey]);
                unset($data[$dataTypeKey]);
                $data[$key] = $value;
            }
        }

        return $data;
    }

    public function serialize(): array
    {
        return get_object_vars($this);
    }
}
