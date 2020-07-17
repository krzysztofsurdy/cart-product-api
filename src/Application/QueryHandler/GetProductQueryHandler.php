<?php

declare(strict_types=1);

namespace App\Application\QueryHandler;

use App\Application\Query\GetProductQuery;
use App\Infrastructure\Products;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class GetProductQueryHandler implements MessageHandlerInterface
{
    private Products $products;

    public function __construct(Products $products)
    {
        $this->products = $products;
    }

    public function __invoke(GetProductQuery $query)
    {
        return $this->products->get($query->getId());
    }
}
