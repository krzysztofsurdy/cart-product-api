<?php

declare(strict_types=1);

namespace App\Application\DTO\Factory\Validator;

use Webmozart\Assert\Assert;

class ProductUpdateRequestDTODataValidator implements ValidatorInterface
{
    public static function validate(array $data): void
    {
        Assert::notEmpty($data);

        if (isset($data['name'])) {
            Assert::notNull($data['name']);
            Assert::string($data['name']);
            Assert::minLength($data['name'], 1);
        }

        if (isset($data['price'])) {
            Assert::notNull($data['price']);
            Assert::greaterThanEq($data['price'], 0);
        }
    }
}
