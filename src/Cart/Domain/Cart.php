<?php
declare(strict_types=1);

namespace App\Cart\Domain;

use App\Cart\Domain\Event\CartCreated;
use App\SharedKernel\Aggregate\AggregateRootApply;
use JsonSerializable;

class Cart implements JsonSerializable
{
    use AggregateRootApply;

    public const LABEL_ID = 'id';
    public const LABEL_PRODUCTS = 'products';
    public const LABEL_PRODUCTS_QUANTITY = 'products_quantity';
    public const LABEL_VALUE = 'value';

    private string $id;
    /** @var CartProduct[] */
    private array $products = [];
    private float $productsQuantity;
    private float $value = 0;

    public static function create(string $id): Cart
    {
        $cart = new self;

        $cart->apply(CartCreated::createFor($id));

        return $cart;
    }

    public function addProduct(CartProduct $product): void
    {
    }

    public function onCartCreated(CartCreated $event): void
    {
        $this->id = $event->aggregateId();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    public function getProductsQuantity(): float
    {
        return $this->productsQuantity;
    }

    public function getValue(): float
    {
        return $this->value;
    }



    public function jsonSerialize()
    {
        return [
            self::LABEL_ID                => $this->id,
            self::LABEL_PRODUCTS          => array_map(function ($product) {
                return $product->jsonSerialize();
            }, $this->products),
            self::LABEL_PRODUCTS_QUANTITY => $this->productsQuantity,
            self::LABEL_VALUE             => $this->value
        ];
    }
}
