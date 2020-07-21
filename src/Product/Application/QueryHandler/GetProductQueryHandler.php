<?php
declare(strict_types=1);

namespace App\Product\Application\QueryHandler;

use App\Product\Application\Query\GetProductQuery;
use App\Product\Domain\Product;
use App\Product\Infrastructure\ProductRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class GetProductQueryHandler implements MessageHandlerInterface
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function __invoke(GetProductQuery $query): Product
    {
        return $this->productRepository->get($query->getId());
    }
}
