<?php

declare(strict_types=1);

namespace App\Domain\CommandHandler;

use App\Application\Command\AddProductCommand;
use App\Domain\Exception\ProductWithNameAlreadyExistsException;
use App\Domain\Product;
use App\Domain\ProductData;
use App\Infrastructure\ProductRepositoryInterface;
use App\Infrastructure\ProductViewRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class AddProductCommandHandler implements MessageHandlerInterface
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
            Product::LABEL_NAME => $command->getName(),
            Product::LABEL_PRICE => $command->getPrice()
        ]));

        $this->products->save($product);
    }
}
