<?php

declare(strict_types=1);

namespace App\Domain\CommandHandler;

use App\Application\Command\UpdateProductCommand;
use App\Domain\Exception\ProductWithNameAlreadyExistsException;
use App\Infrastructure\ProductRepositoryInterface;
use App\Infrastructure\ProductViewRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class UpdateProductCommandHandler implements MessageHandlerInterface
{
    private ProductRepositoryInterface $products;
    private ProductViewRepositoryInterface $productsView;

    public function __construct(ProductRepositoryInterface $products, ProductViewRepositoryInterface $productsView)
    {
        $this->products = $products;
        $this->productsView = $productsView;
    }

    public function __invoke(UpdateProductCommand $command): void
    {
        if ($command->getProductData()->getName() && $this->productsView->getByName($command->getProductData()->getName())) {
            throw new ProductWithNameAlreadyExistsException($command->getProductData()->getName());
        }

        $product = $this->products->get($command->getId());
        $product->getComparer()->compare($command->getProductData());
        $this->products->save($product);
    }
}
