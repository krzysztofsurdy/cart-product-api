<?php

declare(strict_types=1);

namespace App\Product\Application\DTO\Factory\Validator;

use App\Product\Domain\Product;
use App\SharedKernel\Validator\ValidatorInterface;
use Webmozart\Assert\Assert;

final class ProductDeleteRequestDTODataValidator implements ValidatorInterface
{
    public static function validate(array $data): void
    {
        Assert::notEmpty($data);

        Assert::keyExists($data, Product::LABEL_ID);
        Assert::notNull($data[Product::LABEL_ID]);
    }
}
