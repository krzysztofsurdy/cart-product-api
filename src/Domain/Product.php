<?php

declare(strict_types=1);

namespace App\Domain;

use App\Domain\Compare\ProductComparer;
use App\Domain\Event\ProductCreated;
use App\Domain\Event\ProductDeleted;
use App\Domain\Event\ProductNameChanged;
use App\Domain\Event\ProductPriceChanged;
use App\SharedKernel\Aggregate\AggregateRootApply;
use Prooph\EventSourcing\AggregateRoot;
use Ramsey\Uuid\Uuid;

class Product extends AggregateRoot implements Comparable, \JsonSerializable
{
    use AggregateRootApply;

    private string $id;
    private string $name;
    private ProductPrices $prices;
    private \DateTimeInterface $createdAt;
    private ?\DateTimeInterface $deletedAt;

    protected function aggregateId(): string
    {
        return $this->id;
    }

    public function getComparer(): Comparer
    {
        return new ProductComparer($this);
    }

    public static function create(ProductData $productData): Product
    {
        $product = new self();
        $id = (Uuid::uuid1())->toString();
        $product->recordThat(ProductCreated::createFor($id, $productData));

        return $product;
    }

    public function delete(): void
    {
        if (null !== $this->deletedAt) {
            return;
        }

        $this->recordThat(ProductDeleted::createFor($this->id));
    }

    public function changeName(string $name): void
    {
        if ($this->name === $name) {
            return;
        }

        $this->recordThat(
            ProductNameChanged::createFor($this->aggregateId(), $name)
        );
    }

    public function changePrice(ProductPrice $productPrice): void
    {
        $currentPrice = $this->prices->getByCurrency($productPrice->getCurrency());

        if ($currentPrice->getValue() === $productPrice->getValue()) {
            return;
        }

        $this->recordThat(
            ProductPriceChanged::createFor($this->id, $productPrice)
        );
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrices(): ProductPrices
    {
        return $this->prices;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getDeletedAt(): \DateTimeInterface
    {
        return $this->deletedAt;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'prices' => $this->prices->jsonSerialize(),
            'created_at' => $this->createdAt->format('Y-m-d H:i:s'),
            'deleted_at' => $this->deletedAt->format('Y-m-d H:i:s'),
        ];
    }

    protected function onProductCreated(ProductCreated $event): void
    {
        $productData = $event->getProductData();
        $this->id = $event->aggregateId();
        if ($productData->getName()) {
            $this->name = $productData->getName();
        }

        if ($productData->getPrices()) {
            $this->prices = $productData->getPrices();
        }

        $this->createdAt = $event->createdAt();
    }

    protected function onProductDeleted(ProductDeleted $event): void
    {
        $this->deletedAt = $event->createdAt();
    }

    protected function onProductNameChanged(ProductNameChanged $event): void
    {
        $this->name = $event->getName();
    }

    protected function onProductPriceChanged(ProductPriceChanged $event): void
    {
        $this->prices->update($event->getProductPrice());
    }
}
