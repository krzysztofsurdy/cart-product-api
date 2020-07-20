<?php
declare(strict_types=1);

namespace App\Product\Application\DTO\Decorator;

final class DTODataTypeDecorator
{
    private const TYPE_SUFIX = '_type';

    public static function decorate(array $data, string $fieldName, string $type): array
    {
        $data[sprintf('%s%s', $fieldName, self::TYPE_SUFIX)] = $type;
        return $data;
    }
}
