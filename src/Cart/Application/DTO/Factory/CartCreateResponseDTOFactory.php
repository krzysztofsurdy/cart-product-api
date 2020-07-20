<?php
declare(strict_types=1);

namespace App\Cart\Application\DTO\Factory;

use App\Cart\Application\DTO\CartCreateResponseDTO;
use App\Cart\Application\DTO\Factory\Validator\CartCreateResponseDTODataValidator;
use App\SharedKernel\Factory\FromArrayFactory;

trait CartCreateResponseDTOFactory
{
    use FromArrayFactory;

    public static function createFromArray(array $data): CartCreateResponseDTO
    {
        CartCreateResponseDTODataValidator::validate($data);

        $dto = new CartCreateResponseDTO();

        /** @var CartCreateResponseDTO $dto */
        $dto = self::create($dto, $data);

        return $dto;
    }
}
