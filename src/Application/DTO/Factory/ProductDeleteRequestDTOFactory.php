<?php

declare(strict_types=1);

namespace App\Application\DTO\Factory;

use App\Application\DTO\ProductDeleteRequestDTO;
use App\SharedKernel\Factory\FromArrayFactory;

trait ProductDeleteRequestDTOFactory
{
    use FromArrayFactory;

    public static function createFromArray(array $data): ProductDeleteRequestDTO
    {
        $dto = new ProductDeleteRequestDTO();

        /** @var ProductDeleteRequestDTO $dto */
        $dto = self::create($dto, $data);

        return $dto;
    }
}