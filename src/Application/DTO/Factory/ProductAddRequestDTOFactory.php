<?php

declare(strict_types=1);

namespace App\Application\DTO\Factory;

use App\Application\DTO\Decorator\DTODataTypeDecorator;
use App\Application\DTO\Factory\Validator\ProductAddRequestDTOPDataValidator;
use App\Application\DTO\ProductAddRequestDTO;
use App\Domain\Product;
use App\SharedKernel\Factory\FromArrayFactory;

trait ProductAddRequestDTOFactory
{
    use FromArrayFactory;

    public static function createFromArray(array $data): ProductAddRequestDTO
    {
        $dto = new ProductAddRequestDTO();

        ProductAddRequestDTOPDataValidator::validate($data);

        $data = DTODataTypeDecorator::decorate($data, Product::LABEL_NAME, 'string');
        $data = DTODataTypeDecorator::decorate($data, Product::LABEL_PRICE, 'float');

        /** @var ProductAddRequestDTO $dto */
        $dto = self::create($dto, $data);

        return $dto;
    }
}
