<?php
declare(strict_types=1);

namespace App\Cart\Domain\CommandHandler;

use App\Cart\Command\CreateCartCommand;
use App\Cart\Domain\Cart;
use App\Cart\Infrastructure\CartRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CreateCartCommandHandler implements MessageHandlerInterface
{
    private CartRepositoryInterface $cartRepository;

    public function __construct(CartRepositoryInterface $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function __invoke(CreateCartCommand $command): void
    {
        $this->cartRepository->save(Cart::build($command->getId()));
    }
}
