<?php

declare(strict_types=1);

namespace App\Domain\CommandHandler;

use App\Application\Command\AddProductCommand;
use App\Domain\Product;
use App\Domain\ProductData;
use App\Infrastructure\Products;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class AddProductCommandHandler implements MessageHandlerInterface
{
    private Products $products;

    public function __construct(Products $products)
    {
        $this->products = $products;
    }

    public function __invoke(AddProductCommand $command)
    {
        $product = Product::create(ProductData::createFromArray([
            'name' => $command->getName(),
            'prices' => $command->getPrices(),
        ]));

        $this->products->save($product);
    }
}
