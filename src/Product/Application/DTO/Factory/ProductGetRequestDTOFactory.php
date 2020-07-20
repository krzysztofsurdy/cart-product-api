<?php

declare(strict_types=1);

namespace App\Product\Application\DTO\Factory;

use App\Product\Application\DTO\Decorator\DTODataTypeDecorator;
use App\Product\Application\DTO\Factory\Validator\ProductGetRequestDTODataValidator;
use App\Product\Application\DTO\ProductGetRequestDTO;
use App\SharedKernel\Factory\FromArrayFactory;

trait ProductGetRequestDTOFactory
{
    use FromArrayFactory;

    public static function createFromArray(array $data): ProductGetRequestDTO
    {
        ProductGetRequestDTODataValidator::validate($data);

        $dto = new ProductGetRequestDTO();

        if (!isset($data[ProductGetRequestDTO::LABEL_PAGE])) {
            $dto->{ProductGetRequestDTO::LABEL_PAGE} = (int)getenv('API_DEFAULT_FIRST_PAGE');
        } else {
            $data = DTODataTypeDecorator::decorate($data, ProductGetRequestDTO::LABEL_PAGE, 'int');
        }

        if (!isset($data[ProductGetRequestDTO::LABEL_LIMIT])) {
            $dto->{ProductGetRequestDTO::LABEL_LIMIT} = (int)getenv('API_ITEMS_LIMIT');
        } else {
            $data = DTODataTypeDecorator::decorate($data, ProductGetRequestDTO::LABEL_LIMIT, 'int');
        }

        /** @var ProductGetRequestDTO $dto */
        $dto = self::create($dto, $data);

        return $dto;
    }
}
