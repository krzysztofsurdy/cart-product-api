<?php

declare(strict_types=1);

namespace App\Application\DTO\Factory;

use App\Application\DTO\Decorator\DTODataTypeDecorator;
use App\Application\DTO\Factory\Validator\ProductDeleteRequestDTODataValidator;
use App\Application\DTO\ProductDeleteRequestDTO;
use App\Domain\Product;
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
