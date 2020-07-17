<?php

declare(strict_types=1);

namespace App\Domain\CommandHandler;

use App\Application\Command\UpdateProductCommand;
use App\Infrastructure\Products;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class UpdateProductCommandHandler implements MessageHandlerInterface
{
    private Products $products;

    public function __construct(Products $products)
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
