<?php

declare(strict_types=1);

namespace App\Product\Application\QueryHandler;

use App\Product\Application\DTO\ProductGetResponseDTO;
use App\Product\Application\Query\GetProductsQuery;
use App\Product\Infrastructure\ProductViewRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class GetProductsQueryHandler implements MessageHandlerInterface
{
    private ProductViewRepositoryInterface $productsView;

    public function __construct(ProductViewRepositoryInterface $productsView)
    {
        $this->productsView = $productsView;
    }

    public function __invoke(GetProductsQuery $query): ProductGetResponseDTO
    {
        $products = $this->productsView->get($query->getPage(), $query->getLimit());

        return ProductGetResponseDTO::createFromArray([
           ProductGetResponseDTO::LABEL_ITEMS => $products,
           ProductGetResponseDTO::LABEL_ITEMS_TOTAL => $this->productsView->total()
        ]);
    }
}
