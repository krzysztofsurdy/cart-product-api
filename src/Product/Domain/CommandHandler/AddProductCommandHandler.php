<?php

declare(strict_types=1);

namespace App\Product\Domain\CommandHandler;

use App\Product\Application\Command\AddProductCommand;
use App\Product\Domain\Exception\ProductWithNameAlreadyExistsException;
use App\Product\Domain\Product;
use App\Product\Domain\ProductData;
use App\Product\Infrastructure\ProductRepositoryInterface;
use App\Product\Infrastructure\ProductViewRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class AddProductCommandHandler implements MessageHandlerInterface
{
    private const LABEL_NAME = 'name';

    private ProductRepositoryInterface $products;
    private ProductViewRepositoryInterface $productsView;

    public function __construct(ProductRepositoryInterface $products, ProductViewRepositoryInterface $productsView)
    {
        $this->products = $products;
        $this->productsView = $productsView;
    }

    public function __invoke(AddProductCommand $command): void
    {
        if ($this->productsView->getByName($command->getName())) {
            throw new ProductWithNameAlreadyExistsException($command->getName());
        }

        $product = Product::create(ProductData::createFromArray([
            Product::LABEL_ID => $command->getId(),
            Product::LABEL_NAME => $command->getName(),
            Product::LABEL_PRICE => $command->getPrice()
        ]));

        $this->products->save($product);
    }
}
