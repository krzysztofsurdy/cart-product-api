<?php

declare(strict_types=1);

namespace App\Application\DTO\Factory;

use App\Application\DTO\ProductAddRequestDTO;
use App\SharedKernel\Factory\FromArrayFactory;

trait ProductAddRequestDTOFactory
{
    use FromArrayFactory;

    public static function createFromArray(array $data): ProductAddRequestDTO
    {
        $dto = new ProductAddRequestDTO();

        /** @var ProductAddRequestDTO $dto */
        $dto = self::create($dto, $data);

        return $dto;
    }
}
