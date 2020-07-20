<?php

declare(strict_types=1);

namespace App\Product\Application\DTO\Factory\Validator;

interface ValidatorInterface
{
    public static function validate(array $data): void;
}
