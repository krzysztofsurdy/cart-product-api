<?php
declare(strict_types=1);

namespace App\Cart\Application\DTO\Factory\Validator;

use App\SharedKernel\Validator\ValidatorInterface;
use Webmozart\Assert\Assert;

class DeleteCartProductRequestDTODataValidator implements ValidatorInterface
{
    public static function validate(array $data): void
    {
        Assert::keyExists($data, 'cart_id');
        Assert::keyExists($data, 'product_id');
    }
}
