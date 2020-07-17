<?php
declare(strict_types=1);

namespace App\Domain;

use App\Domain\Compare\ProductComparer;
use App\Domain\Event\ProductCreated;
use App\Domain\Event\ProductNameChanged;
use Prooph\EventSourcing\AggregateRoot;
use App\SharedKernel\AggregateRootApply;
use Ramsey\Uuid\Uuid;

class Product extends AggregateRoot implements Comparable
{
    use AggregateRootApply;

    private string $name;
    private ProductPrices $prices;

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

    public function changeName(string $name): void
    {
        if ($this->name === $name) {
            return;
        }

        $this->recordThat(
            ProductNameChanged::createFor($this->aggregateId(), $name)
        );
    }

    protected function onProductCreated(ProductCreated $event): void
    {
        $productData = $event->getProductData();
        $this->aggregateId = $event->aggregateId();
        if($productData->getName()) {
            $this->name = $productData->getName();
        }

        if($productData->getPrices()) {
            $this->prices = $productData->getPrices();
        }
    }

    protected function onProductNameChanged(ProductNameChanged $event): void
    {
        $this->name = $event->getName();
    }
}
