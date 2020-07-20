<?php
declare(strict_types=1);

namespace App\Product\Application\DTO\Decorator;

use App\Product\Application\DTO\ProductGetResponseDTO;
use App\Product\Domain\Product;

final class ProductGetResponseDTODecorator
{
    public static function decorate(ProductGetResponseDTO $dto, int $page, int $limit): ProductGetResponseDTO
    {
        $dto->setPage($page);
        $dto->setLimit($limit);

        $pages = $dto->getItemsTotal() / $limit ?? 0;
        $dto->setPages((int)ceil($pages));

        return $dto;
    }
}
