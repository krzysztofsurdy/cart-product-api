<?php
declare(strict_types=1);

namespace App\Product\Application\DTO\Factory\Validator;

use App\Product\Application\DTO\ProductGetResponseDTO;
use App\SharedKernel\Validator\ValidatorInterface;
use Webmozart\Assert\Assert;

final class ProductGetResponseDTODataValidator implements ValidatorInterface
{
    public static function validate(array $data): void
    {
        Assert::isArray($data[ProductGetResponseDTO::LABEL_ITEMS]);
        Assert::integer($data[ProductGetResponseDTO::LABEL_ITEMS_TOTAL]);
    }
}
