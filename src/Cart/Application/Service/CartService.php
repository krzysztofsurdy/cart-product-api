<?php
declare(strict_types=1);

namespace App\Cart\Application\Service;

use App\Cart\Application\Command\AddCartProductCommand;
use App\Cart\Application\DTO\AddCartProductRequestDTO;
use App\Cart\Application\DTO\CartCreateResponseDTO;
use App\Cart\Application\Query\GetCartQuery;
use App\Cart\Command\CreateCartCommand;
use App\Cart\Domain\Cart;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

class CartService
{
    private MessageBusInterface $cartQueryBus;
    private MessageBusInterface $cartCommandBus;

    public function create(): CartCreateResponseDTO
    {
        $id = Uuid::uuid1()->toString();

        $this->cartCommandBus->dispatch(new CreateCartCommand($id));

        return CartCreateResponseDTO::createFromArray([
            Cart::LABEL_ID => $id
        ]);
    }

    public function get(string $id): Cart
    {
        $envelope = $this->cartQueryBus->dispatch(new GetCartQuery($id));

        /** @var HandledStamp $handledStamp */
        $handledStamp = $envelope->last(HandledStamp::class);

        return $handledStamp->getResult();
    }

    public function addProduct(AddCartProductRequestDTO $requestDTO): void
    {
        $this->cartCommandBus->dispatch(new AddCartProductCommand($requestDTO->getCartId(), $requestDTO->getProduct()));
    }
}
