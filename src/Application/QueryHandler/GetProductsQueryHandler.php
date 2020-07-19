<?php

declare(strict_types=1);

namespace App\Application\QueryHandler;

use App\Application\DTO\ProductGetResponseDTO;
use App\Application\Query\GetProductsQuery;
use App\Infrastructure\ProductViewRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class GetProductsQueryHandler implements MessageHandlerInterface
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
