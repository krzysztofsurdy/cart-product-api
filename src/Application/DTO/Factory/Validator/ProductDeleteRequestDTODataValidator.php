<?php

declare(strict_types=1);

namespace App\Application\DTO\Factory\Validator;

use Webmozart\Assert\Assert;

class ProductDeleteRequestDTODataValidator implements ValidatorInterface
{
    public static function validate(array $data): void
    {
        Assert::notEmpty($data);

        Assert::keyExists($data, 'id');
        Assert::notNull($data['id']);
    }
}
