<?php

declare(strict_types=1);

namespace App\Product\Domain\CommandHandler;

use App\Product\Application\Command\DeleteProductCommand;
use App\Product\Infrastructure\ProductRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class DeleteProductCommandHandler implements MessageHandlerInterface
{
    private ProductRepositoryInterface $products;

    public function __construct(ProductRepositoryInterface $products)
    {
        $this->products = $products;
    }

    public function __invoke(DeleteProductCommand $command): void
    {
        $product = $this->products->get($command->getId());
        $product->delete();

        $this->products->save($product);
    }
}
