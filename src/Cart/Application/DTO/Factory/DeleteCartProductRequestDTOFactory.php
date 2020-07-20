<?php
declare(strict_types=1);

namespace App\Cart\Application\DTO\Factory;

use App\Cart\Application\DTO\DeleteCartProductRequestDTO;
use App\Cart\Application\DTO\Factory\Validator\DeleteCartProductRequestDTODataValidator;
use App\SharedKernel\Factory\FromArrayFactory;

trait DeleteCartProductRequestDTOFactory
{
    use FromArrayFactory;

    public static function createFromArray(array $data): DeleteCartProductRequestDTO
    {
        DeleteCartProductRequestDTODataValidator::validate($data);

        $dto = new DeleteCartProductRequestDTO();

        /** @var DeleteCartProductRequestDTO $dto */
        $dto = self::create($dto, $data);

        return $dto;
    }
}
