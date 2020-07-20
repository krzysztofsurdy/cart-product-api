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

        $dto = self::decoratePrices($dto);

        $pages = $dto->getItemsTotal() / $limit ?? 0;
        $dto->setPages((int)ceil($pages));

        return $dto;
    }

    private static function decoratePrices(ProductGetResponseDTO $dto): ProductGetResponseDTO
    {
        $items = [];

        foreach ($dto->getItems() as $item) {
            $item[Product::LABEL_PRICE] = sprintf($item[Product::LABEL_PRICE] . ' %s', 'USD'); // TODO RESOLVE ENV ISSUE
            $items[] = $item;
        }

        $dto->setItems($items);
        return $dto;
    }
}
