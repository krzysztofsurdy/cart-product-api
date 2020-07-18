<?php

declare(strict_types=1);

namespace App\Domain\CommandHandler;

use App\Application\Command\UpdateProductCommand;
use App\Infrastructure\ProductRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class UpdateProductCommandHandler implements MessageHandlerInterface
{
    private ProductRepositoryInterface $products;

    public function __construct(ProductRepositoryInterface $products)
    {
        $this->products = $products;
    }

    public function __invoke(UpdateProductCommand $command)
    {
        $product = $this->products->get($command->getId());
        $product->getComparer()->compare($command->getProductData());
        $this->products->save($product);
    }
}
