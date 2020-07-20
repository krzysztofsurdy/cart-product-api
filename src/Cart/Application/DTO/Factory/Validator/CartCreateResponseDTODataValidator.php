<?php
declare(strict_types=1);

namespace App\Cart\Application\DTO\Factory\Validator;

use App\SharedKernel\Validator\ValidatorInterface;
use Webmozart\Assert\Assert;

class CartCreateResponseDTODataValidator implements ValidatorInterface
{
    public static function validate(array $data): void
    {
        Assert::keyExists($data, 'id');
    }
}
