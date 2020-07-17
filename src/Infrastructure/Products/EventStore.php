<?php

declare(strict_types=1);

namespace App\Infrastructure\Products;

use App\Domain\Product;
use App\Infrastructure\Exception\ProductNotFound;
use App\Infrastructure\Products;
use Prooph\EventSourcing\Aggregate\AggregateRepository;
use Prooph\EventSourcing\Aggregate\AggregateType;
use Prooph\EventSourcing\EventStoreIntegration\AggregateTranslator;
use Prooph\EventStore\EventStore as ProophEventStore;
use Prooph\EventStore\Stream;
use Prooph\EventStore\StreamName;
use Prooph\SnapshotStore\SnapshotStore;

class EventStore extends AggregateRepository implements Products
{
    public function __construct(
        ProophEventStore $productEventStore,
        string $productEventStreamName,
        SnapshotStore $productSnapshotStore
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
            $productSnapshotStore,
            $streamName,
            false,
            true
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
