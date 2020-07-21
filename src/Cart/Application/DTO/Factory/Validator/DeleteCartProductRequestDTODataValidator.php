<?php
declare(strict_types=1);

namespace App\Cart\Application\DTO\Factory\Validator;

use App\Cart\Application\DTO\DeleteCartProductRequestDTO;
use App\SharedKernel\Validator\ValidatorInterface;
use Webmozart\Assert\Assert;

final class DeleteCartProductRequestDTODataValidator implements ValidatorInterface
{
    public static function validate(array $data): void
    {
        Assert::keyExists($data, DeleteCartProductRequestDTO::LABEL_CART_ID);
        Assert::keyExists($data, DeleteCartProductRequestDTO::LABEL_PRODUCT_ID);
    }
}
