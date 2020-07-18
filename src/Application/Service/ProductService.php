<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Application\Command\AddProductCommand;
use App\Application\Command\DeleteProductCommand;
use App\Application\Command\UpdateProductCommand;
use App\Application\DTO\ProductAddRequestDTO;
use App\Application\DTO\ProductDeleteRequestDTO;
use App\Application\DTO\ProductGetRequestDTO;
use App\Application\DTO\ProductUpdateRequestDTO;
use App\Application\Query\GetProductQuery;
use App\Domain\Product;
use App\Domain\ProductData;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

class ProductService
{
    private MessageBusInterface $productQueryBus;
    private MessageBusInterface $productCommandBus;

    public function __construct(MessageBusInterface $productQueryBus, MessageBusInterface $productCommandBus)
    {
        $this->productQueryBus = $productQueryBus;
        $this->productCommandBus = $productCommandBus;
    }

    public function get(ProductGetRequestDTO $requestDTO): Product
    {
        $envelope = $this->productQueryBus->dispatch(new GetProductQuery($requestDTO->getId()));

        /** @var HandledStamp $handledStamp */
        $handledStamp = $envelope->last(HandledStamp::class);

        return $handledStamp->getResult();
    }

    public function add(ProductAddRequestDTO $requestDTO): void
    {
        $this->productCommandBus->dispatch(new AddProductCommand($requestDTO->getName(), $requestDTO->getPrices()));
    }

    public function delete(ProductDeleteRequestDTO $requestDTO): void
    {
        $this->productCommandBus->dispatch(new DeleteProductCommand($requestDTO->getId()));
    }

    public function update(ProductUpdateRequestDTO $requestDTO): void
    {
        $this->productCommandBus->dispatch(
            new UpdateProductCommand(
                $requestDTO->getId(),
                ProductData::createFromArray($requestDTO->serialize())
            )
        );
    }
}
