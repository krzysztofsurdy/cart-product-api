<?php
declare(strict_types=1);

namespace App\Cart\Application\DTO\Factory;

use App\Cart\Application\DTO\AddCartProductRequestDTO;
use App\Cart\Application\DTO\Factory\Validator\AddCartProductRequestDTODataValidator;
use App\SharedKernel\Factory\FromArrayFactory;

trait AddCartProductRequestDTOFactory
{
    use FromArrayFactory;

    public static function createFromArray(array $data): AddCartProductRequestDTO
    {
        unset($data['product_id']);
        AddCartProductRequestDTODataValidator::validate($data);

        $dto = new AddCartProductRequestDTO();

        /** @var AddCartProductRequestDTO $dto */
        $dto = self::create($dto, $data);
        return $dto;
    }
}
