<?php

declare(strict_types=1);

namespace App\Domain\CommandHandler;

use App\Application\Command\AddProductCommand;
use App\Domain\Product;
use App\Domain\ProductData;
use App\Infrastructure\ProductRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class AddProductCommandHandler implements MessageHandlerInterface
{
    private ProductRepositoryInterface $products;

    public function __construct(ProductRepositoryInterface $products)
    {
        $this->products = $products;
    }

    public function __invoke(AddProductCommand $command)
    {
        $product = Product::create(ProductData::createFromArray([
            'name' => $command->getName(),
            'price' => $command->getPrice(),
        ]));

        $this->products->save($product);
    }
}
