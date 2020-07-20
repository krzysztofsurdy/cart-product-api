<?php

declare(strict_types=1);

namespace App\Product\Application\DTO\Factory;

use App\Product\Application\DTO\Decorator\DTODataTypeDecorator;
use App\Product\Application\DTO\Factory\Validator\ProductDeleteRequestDTODataValidator;
use App\Product\Application\DTO\ProductDeleteRequestDTO;
use App\Product\Domain\Product;
use App\SharedKernel\Factory\FromArrayFactory;

trait ProductDeleteRequestDTOFactory
{
    use FromArrayFactory;

    public static function createFromArray(array $data): ProductDeleteRequestDTO
    {
        ProductDeleteRequestDTODataValidator::validate($data);

        $dto = new ProductDeleteRequestDTO();

        $data = DTODataTypeDecorator::decorate($data, Product::LABEL_ID, 'string');

        /** @var ProductDeleteRequestDTO $dto */
        $dto = self::create($dto, $data);

        return $dto;
    }
}
