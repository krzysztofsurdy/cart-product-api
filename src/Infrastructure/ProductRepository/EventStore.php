<?php

declare(strict_types=1);

namespace App\Infrastructure\ProductRepository;

use App\Domain\Product;
use App\Infrastructure\Exception\ProductNotFound;
use App\Infrastructure\ProductRepositoryInterface;
use Prooph\EventSourcing\Aggregate\AggregateRepository;
use Prooph\EventSourcing\Aggregate\AggregateType;
use Prooph\EventSourcing\EventStoreIntegration\AggregateTranslator;
use Prooph\EventStore\EventStore as ProophEventStore;
use Prooph\EventStore\Stream;
use Prooph\EventStore\StreamName;

class EventStore extends AggregateRepository implements ProductRepositoryInterface
{
    public function __construct(
        ProophEventStore $productEventStore,
        string $productEventStreamName
    ) {
        $streamName = new StreamName($productEventStreamName);
        $stream = new Stream($streamName, new \ArrayIterator());

        if (!$productEventStore->hasStream($streamName)) {
            $productEventStore->create($stream);
        }

        parent::__construct(
            $productEventStore,
            AggregateType::fromAggregateRootClass(Product::class),
            new AggregateTranslator(),
            null,
            $streamName
        );
    }

    public function get(string $id): Product
    {
        $product = $this->getAggregateRoot($id);

        if (!$product) {
            throw new ProductNotFound($id);
        }

        return $product;
    }

    public function save(Product $product): void
    {
        $this->saveAggregateRoot($product);
    }
}
