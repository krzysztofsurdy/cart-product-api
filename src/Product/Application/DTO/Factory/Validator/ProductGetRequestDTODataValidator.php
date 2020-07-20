<?php

declare(strict_types=1);

namespace App\Product\Application\DTO\Factory\Validator;

use Webmozart\Assert\Assert;

class ProductGetRequestDTODataValidator implements ValidatorInterface
{
    public static function validate(array $data): void
    {
        Assert::notEmpty($data);
    }
}
