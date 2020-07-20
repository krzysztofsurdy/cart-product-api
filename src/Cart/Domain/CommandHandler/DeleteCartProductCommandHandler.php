<?php
declare(strict_types=1);

namespace App\Cart\Domain\CommandHandler;

use App\Cart\Application\Service\CartService;
use App\Cart\Command\DeleteCartProductCommand;
use App\Cart\Infrastructure\CartRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class DeleteCartProductCommandHandler implements MessageHandlerInterface
{
    private CartService $cartService;
    private CartRepositoryInterface $cartRepository;

    public function __construct(CartService $cartService, CartRepositoryInterface $cartRepository)
    {
        $this->cartService = $cartService;
        $this->cartRepository = $cartRepository;
    }

    public function __invoke(DeleteCartProductCommand $command): void
    {
        $cart = $this->cartService->get($command->getCartId());

        $cart->deleteProduct($command->getProductId());
        $this->cartRepository->save($cart);
    }
}
