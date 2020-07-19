<?php

declare(strict_types=1);

namespace App\SharedKernel\DataDeserializer;

final class FloorToCamelCase
{
    public static function serialize(string $string): string
    {
        $str = str_replace('_', '', ucwords($string, '_'));

        $str = lcfirst($str);

        return $str;
    }
}
