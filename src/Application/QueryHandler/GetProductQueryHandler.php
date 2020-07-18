<?php

declare(strict_types=1);

namespace App\Application\QueryHandler;

use App\Application\Query\GetProductQuery;
use App\Infrastructure\ProductRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class GetProductQueryHandler implements MessageHandlerInterface
{
    private ProductRepositoryInterface $products;

    public function __construct(ProductRepositoryInterface $products)
    {
        $this->products = $products;
    }

    public function __invoke(GetProductQuery $query)
    {
        return $this->products->get($query->getId());
    }
}
