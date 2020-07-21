<?php
declare(strict_types=1);

namespace App\Cart\Application\DTO\Factory\Validator;

use App\Cart\Application\DTO\AddCartProductRequestDTO;
use App\SharedKernel\Validator\ValidatorInterface;
use Webmozart\Assert\Assert;

class AddCartProductRequestDTODataValidator implements ValidatorInterface
{
    public static function validate(array $data): void
    {
        Assert::keyExists($data, AddCartProductRequestDTO::LABEL_CART_ID);
    }
}
