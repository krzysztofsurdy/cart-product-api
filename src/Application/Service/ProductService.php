<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Application\Command\AddProductCommand;
use App\Application\Command\DeleteProductCommand;
use App\Application\Command\UpdateProductCommand;
use App\Application\Query\GetProductQuery;
use App\Domain\Product;
use App\Domain\ProductData;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Webmozart\Assert\Assert;

class ProductService
{
    private MessageBusInterface $productQueryBus;
    private MessageBusInterface $productCommandBus;

    public function __construct(MessageBusInterface $productQueryBus, MessageBusInterface $productCommandBus)
    {
        $this->productQueryBus = $productQueryBus;
        $this->productCommandBus = $productCommandBus;
    }

    public function get(string $id): Product
    {
        $envelope = $this->productQueryBus->dispatch(new GetProductQuery($id));

        /** @var HandledStamp $handledStamp */
        $handledStamp = $envelope->last(HandledStamp::class);

        return $handledStamp->getResult();
    }

    public function add(array $data): void
    {
        Assert::keyExists($data, 'name');
        Assert::keyExists($data, 'prices');

        $this->productCommandBus->dispatch(new AddProductCommand($data['name'], $data['prices']));
    }

    public function delete(string $id): void
    {
        $this->productCommandBus->dispatch(new DeleteProductCommand($id));
    }

    public function update(array $data): void
    {
        Assert::keyExists($data, 'id');

        $commandData = [];

        if (isset($data['name'])) {
            $commandData['name'] = $data['name'];
        }

        if (isset($data['prices'])) {
            $commandData['price'] = $data['prices'];
        }
        $this->productCommandBus->dispatch(new UpdateProductCommand($data['id'], ProductData::createFromArray($commandData)));
    }
}
