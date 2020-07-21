<?php

declare(strict_types=1);

namespace App\Product\Application\DTO\Factory\Validator;

use App\Product\Domain\Product;
use App\SharedKernel\Validator\ValidatorInterface;
use Webmozart\Assert\Assert;

final class ProductUpdateRequestDTODataValidator implements ValidatorInterface
{
    public static function validate(array $data): void
    {
        Assert::notEmpty($data);

        if (isset($data[Product::LABEL_NAME])) {
            Assert::notNull($data[Product::LABEL_NAME]);
            Assert::string($data[Product::LABEL_NAME]);
            Assert::minLength($data[Product::LABEL_NAME], 1);
        }

        if (isset($data[Product::LABEL_PRICE])) {
            Assert::notNull($data[Product::LABEL_PRICE]);
            Assert::greaterThanEq($data[Product::LABEL_PRICE], 0);
        }
    }
}
