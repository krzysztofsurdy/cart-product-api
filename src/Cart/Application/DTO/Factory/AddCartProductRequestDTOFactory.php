<?php
declare(strict_types=1);

namespace App\Cart\Application\DTO\Factory;

use App\Cart\Application\DTO\AddCartProductRequestDTO;
use App\Cart\Application\DTO\Factory\Validator\AddCartProductRequestDTODataValidator;
use App\SharedKernel\Factory\FromArrayFactory;

class AddCartProductRequestDTOFactory
{
    use FromArrayFactory;

//    public static function createFromArray(array $data): AddCartProductRequestDTO
//    {
//        AddCartProductRequestDTODataValidator::validate($data);
//
//        $dto = new AddCartProductRequestDTO();
//
//        if (!isset($data[AddCartProductRequestDTO::LABEL_PRODUCT])) {
//            $dto->{ProductGetRequestDTO::LABEL_PAGE} = 1; // TODO HERE
//        } else {
//            $data = DTODataTypeDecorator::decorate($data, ProductGetRequestDTO::LABEL_PAGE, 'int');
//        }
//
//        /** @var AddCartProductRequestDTO $dto */
//        $dto = self::create($dto, $data);
//
//        return $dto;
//    }
}
