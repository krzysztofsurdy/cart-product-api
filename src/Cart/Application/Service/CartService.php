<?php
declare(strict_types=1);

namespace App\Cart\Application\Service;

use App\Cart\Command\CreateCartCommand;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Messenger\MessageBusInterface;

class CartService
{
    private MessageBusInterface $cartQueryBus;
    private MessageBusInterface $cartCommandBus;

    public function create(): string
    {
        $id = Uuid::uuid1()->toString();

        $this->cartCommandBus->dispatch(new CreateCartCommand($id));

        return $id;
    }
}
