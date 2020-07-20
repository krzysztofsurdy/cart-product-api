<?php

declare(strict_types=1);

namespace App\Product\Domain;

use App\Product\Domain\Compare\ProductComparer;
use App\Product\Domain\Event\ProductCreated;
use App\Product\Domain\Event\ProductDeleted;
use App\Product\Domain\Event\ProductNameChanged;
use App\Product\Domain\Event\ProductPriceChanged;
use App\SharedKernel\Aggregate\AggregateRootApply;
use App\SharedKernel\Compare\ComparableInterface;
use App\SharedKernel\Compare\ComparerInterface;
use App\SharedKernel\Dictionary\DateFormat;
use DateTimeInterface;
use JsonSerializable;
use Prooph\EventSourcing\AggregateRoot;

final class Product extends AggregateRoot implements ComparableInterface, JsonSerializable
{
    use AggregateRootApply;

    public const LABEL_ID = 'id';
    public const LABEL_NAME = 'name';
    public const LABEL_PRICE = 'price';
    public const LABEL_CREATED_AT = 'created_at';
    public const LABEL_DELETED_AT = 'deleted_at';

    private string $id;
    private string $name;
    private float $price;
    private DateTimeInterface $createdAt;
    private ?DateTimeInterface $deletedAt;

    protected function aggregateId(): string
    {
        return $this->id;
    }

    public function getComparer(): ComparerInterface
    {
        return new ProductComparer($this);
    }


    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public static function create(ProductData $productData): Product
    {
        $product = new self();
        $product->recordThat(ProductCreated::createFor($productData->getId(), $productData));

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

    public function changePrice(float $value): void
    {
        if ($this->price === $value) {
            return;
        }

        $this->recordThat(
            ProductPriceChanged::createFor($this->id, $value)
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

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getDeletedAt(): ?DateTimeInterface
    {
        return $this->deletedAt;
    }

    public function jsonSerialize(): array
    {
        return [
            self::LABEL_ID => $this->id,
            self::LABEL_NAME => $this->name,
            self::LABEL_PRICE => $this->price,
            self::LABEL_CREATED_AT => $this->createdAt->format(DateFormat::DEFAULT),
            self::LABEL_DELETED_AT => $this->deletedAt ? $this->deletedAt->format(DateFormat::DEFAULT) : null,
        ];
    }

    public function getProductData(): ProductData
    {
        return ProductData::createFromArray([
            self::LABEL_ID => $this->id,
            self::LABEL_NAME => $this->name,
            self::LABEL_PRICE => $this->price,
        ]);
    }

    protected function onProductCreated(ProductCreated $event): void
    {
        $productData = $event->getProductData();
        $this->id = $event->aggregateId();
        if ($productData->getName()) {
            $this->name = (string)$productData->getName();
        }

        if ($productData->getPrice()) {
            $this->price = (float)$productData->getPrice();
        }

        $this->createdAt = $event->createdAt();
        $this->deletedAt = null;
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
        $this->price = $event->getPrice();
    }
}
