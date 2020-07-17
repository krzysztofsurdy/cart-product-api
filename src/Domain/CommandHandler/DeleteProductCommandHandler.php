<?php

declare(strict_types=1);

namespace App\Domain\CommandHandler;

use App\Application\Command\DeleteProductCommand;
use App\Infrastructure\Products;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class DeleteProductCommandHandler implements MessageHandlerInterface
{
    private Products $products;

    public function __construct(Products $products)
    {
        $this->products = $products;
    }

    public function __invoke(DeleteProductCommand $command)
    {
        $product = $this->products->get($command->getId());
        $product->delete();

        $this->products->save($product);
    }
}
