<?php

declare(strict_types=1);

namespace App\Application\DTO\Factory;

use App\Application\DTO\Decorator\DTODataTypeDecorator;
use App\Application\DTO\Factory\Validator\ProductUpdateRequestDTODataValidator;
use App\Application\DTO\ProductUpdateRequestDTO;
use App\Domain\Product;
use App\SharedKernel\Factory\FromArrayFactory;

trait ProductUpdateRequestDTOFactory
{
    use FromArrayFactory;

    public static function createFromArray(array $data): ProductUpdateRequestDTO
    {
        ProductUpdateRequestDTODataValidator::validate($data);

        $dto = new ProductUpdateRequestDTO();

        if (isset($data[Product::LABEL_ID])) {
            $data = DTODataTypeDecorator::decorate($data, Product::LABEL_ID, 'string');
        }

        if (isset($data[Product::LABEL_NAME])) {
            $data = DTODataTypeDecorator::decorate($data, Product::LABEL_NAME, 'string');
        }

        if (isset($data[Product::LABEL_PRICE])) {
            $data = DTODataTypeDecorator::decorate($data, Product::LABEL_PRICE, 'float');
        }

        /** @var ProductUpdateRequestDTO $dto */
        $dto = self::create($dto, $data);

        return $dto;
    }
}
