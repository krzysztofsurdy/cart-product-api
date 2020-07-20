<?php

declare(strict_types=1);

namespace App\Product\Application\Service;

use App\Product\Application\Command\AddProductCommand;
use App\Product\Application\Command\DeleteProductCommand;
use App\Product\Application\Command\UpdateProductCommand;
use App\Product\Application\DTO\Decorator\ProductGetResponseDTODecorator;
use App\Product\Application\DTO\ProductAddRequestDTO;
use App\Product\Application\DTO\ProductDeleteRequestDTO;
use App\Product\Application\DTO\ProductGetRequestDTO;
use App\Product\Application\DTO\ProductGetResponseDTO;
use App\Product\Application\DTO\ProductUpdateRequestDTO;
use App\Product\Application\Query\GetProductsQuery;
use App\Product\Domain\ProductData;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

final class ProductService
{
    private MessageBusInterface $productQueryBus;
    private MessageBusInterface $productCommandBus;

    public function __construct(MessageBusInterface $productQueryBus, MessageBusInterface $productCommandBus)
    {
        $this->productQueryBus = $productQueryBus;
        $this->productCommandBus = $productCommandBus;
    }

    public function get(ProductGetRequestDTO $requestDTO): ProductGetResponseDTO
    {
        $envelope = $this->productQueryBus->dispatch(
            new GetProductsQuery(
                $requestDTO->getPage(),
                $requestDTO->getLimit()
            )
        );

        /** @var HandledStamp $handledStamp */
        $handledStamp = $envelope->last(HandledStamp::class);

        /** @var ProductGetResponseDTO $response */
        $response = $handledStamp->getResult();


        return ProductGetResponseDTODecorator::decorate($response, $requestDTO->getPage(), $requestDTO->getLimit());
    }

    public function add(ProductAddRequestDTO $requestDTO): void
    {
        $this->productCommandBus->dispatch(new AddProductCommand($requestDTO->getName(), $requestDTO->getPrice()));
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
