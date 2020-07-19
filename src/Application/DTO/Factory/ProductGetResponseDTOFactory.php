<?php
declare(strict_types=1);

namespace App\Application\DTO\Factory;

use App\Application\DTO\Decorator\DTODataTypeDecorator;
use App\Application\DTO\Factory\Validator\ProductGetResponseDTODataValidator;
use App\Application\DTO\ProductGetResponseDTO;
use App\SharedKernel\Factory\FromArrayFactory;

trait ProductGetResponseDTOFactory
{
    use FromArrayFactory;

    public static function createFromArray(array $data): ProductGetResponseDTO
    {
        ProductGetResponseDTODataValidator::validate($data);

        $dto = new ProductGetResponseDTO();

        if (isset($data[ProductGetResponseDTO::LABEL_ITEMS_TOTAL])) {
            $data = DTODataTypeDecorator::decorate($data, ProductGetResponseDTO::LABEL_ITEMS_TOTAL, 'int');
        }

        if (isset($data[ProductGetResponseDTO::LABEL_PAGE])) {
            $data = DTODataTypeDecorator::decorate($data, ProductGetResponseDTO::LABEL_PAGE, 'int');
        }

        if (isset($data[ProductGetResponseDTO::LABEL_PAGES])) {
            $data = DTODataTypeDecorator::decorate($data, ProductGetResponseDTO::LABEL_PAGES, 'int');
        }

        if (isset($data[ProductGetResponseDTO::LABEL_LIMIT])) {
            $data = DTODataTypeDecorator::decorate($data, ProductGetResponseDTO::LABEL_LIMIT, 'int');
        }
        /** @var ProductGetResponseDTO $dto */
        $dto = self::create($dto, $data);

        return $dto;
    }
}
