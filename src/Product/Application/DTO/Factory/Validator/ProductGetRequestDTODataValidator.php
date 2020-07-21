<?php

declare(strict_types=1);

namespace App\Product\Application\DTO\Factory\Validator;

use App\SharedKernel\Validator\ValidatorInterface;
use Webmozart\Assert\Assert;

final class ProductGetRequestDTODataValidator implements ValidatorInterface
{
    public static function validate(array $data): void
    {
        Assert::isArray($data);
    }
}
