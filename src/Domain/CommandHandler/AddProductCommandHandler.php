<?php
declare(strict_types=1);

namespace App\Domain\CommandHandler;

use App\Application\Command\AddProductCommand;
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
        
    }


}
