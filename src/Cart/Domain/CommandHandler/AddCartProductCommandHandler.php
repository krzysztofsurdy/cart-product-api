<?php
declare(strict_types=1);

namespace App\Cart\Domain\CommandHandler;

use App\Cart\Application\Command\AddCartProductCommand;
use App\Cart\Infrastructure\CartRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class AddCartProductCommandHandler implements MessageHandlerInterface
{
    private CartRepositoryInterface $cartRepository;

    public function __construct(CartRepositoryInterface $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function __invoke(AddCartProductCommand $command)
    {
        // TODO: Implement __invoke() method.
    }
}
