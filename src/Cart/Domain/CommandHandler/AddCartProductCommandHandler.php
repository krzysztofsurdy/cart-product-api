<?php
declare(strict_types=1);

namespace App\Cart\Domain\CommandHandler;

use App\Cart\Application\Command\AddCartProductCommand;
use App\Cart\Application\Service\CartService;
use App\Cart\Infrastructure\CartRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class AddCartProductCommandHandler implements MessageHandlerInterface
{
    private CartService $cartService;
    private CartRepositoryInterface $cartRepository;

    public function __construct(CartService $cartService, CartRepositoryInterface $cartRepository)
    {
        $this->cartService = $cartService;
        $this->cartRepository = $cartRepository;
    }


    public function __invoke(AddCartProductCommand $command): void
    {
        $cart = $this->cartService->get($command->getCartId());
        $cart->addProduct($command->getProductData());
        $this->cartRepository->save($cart);
    }
}
