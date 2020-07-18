<?php

declare(strict_types=1);

namespace App\Application\DTO\Factory;

use App\Application\DTO\ProductUpdateRequestDTO;
use App\SharedKernel\Factory\FromArrayFactory;

trait ProductUpdateRequestDTOFactory
{
    use FromArrayFactory;

    public static function createFromArray(array $data): ProductUpdateRequestDTO
    {
        $dto = new ProductUpdateRequestDTO();

        /** @var ProductUpdateRequestDTO $dto */
        $dto = self::create($dto, $data);

        return $dto;
    }
}
