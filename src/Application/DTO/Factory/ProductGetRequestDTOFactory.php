<?php

declare(strict_types=1);

namespace App\Application\DTO\Factory;

use App\Application\DTO\ProductGetRequestDTO;
use App\SharedKernel\Factory\FromArrayFactory;

trait ProductGetRequestDTOFactory
{
    use FromArrayFactory;

    public static function createFromArray(array $data): ProductGetRequestDTO
    {
        $dto = new ProductGetRequestDTO();

        /** @var ProductGetRequestDTO $dto */
        $dto = self::create($dto, $data);

        return $dto;
    }
}
