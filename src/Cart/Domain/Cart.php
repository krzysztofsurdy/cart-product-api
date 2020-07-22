<?php
declare(strict_types=1);

namespace App\Cart\Domain;

use App\Cart\Domain\Event\CartCreated;
use App\Cart\Domain\Event\CartProductAdded;
use App\Cart\Domain\Event\CartProductDeleted;
use App\Cart\Domain\Exception\CartProductNotFound;
use App\Cart\Domain\Exception\ProductQuantityInBasketExceedException;
use App\Cart\Domain\Exception\ProductsInBasketExceedException;
use App\Cart\Domain\Factory\CartFactory;
use App\Product\Domain\ProductData;
use App\SharedKernel\Aggregate\AggregateRootApply;
use JsonSerializable;

final class Cart implements JsonSerializable
{
    use AggregateRootApply;
    use CartFactory;

    public const LABEL_ID = 'id';
    public const LABEL_PRODUCTS = 'products';
    public const LABEL_PRODUCTS_QUANTITY = 'products_quantity';
    public const LABEL_VALUE = 'value';

    private string $id;
    /** @var CartProduct[] */
    private array $products = [];
    private float $productsQuantity = 0;
    private float $value = 0;


    public static function build(string $id): Cart
    {
        $cart = new self;

        $cart->apply(CartCreated::createFor($id));

        return $cart;
    }

    public function addProduct(ProductData $productData): void
    {
        $this->apply(CartProductAdded::createFor($this->id, $productData));
    }

    public function deleteProduct(string $productId): void
    {
        $this->apply(CartProductDeleted::createFor($this->id, $productId));
    }

    public function onCartCreated(CartCreated $event): void
    {
        $this->id = $event->aggregateId();
    }

    public function onCartProductAdded(CartProductAdded $event): void
    {
        if ($this->doesExceedMaxItems()) {
            throw new ProductsInBasketExceedException();
        }

        if ($this->doesExceedMaxQuantityOfProduct($event->getProductData()->getName())) {
            throw new ProductQuantityInBasketExceedException();
        }

        $productExist = false;

        foreach ($this->products as $productIndex => $product) {
            if ($product->getProductData()->getName() === $event->getProductData()->getName()) {
                $this->products[$productIndex]->incrementQuantity();
                $productExist = true;
            }
        }


        if (!$productExist) {
            $this->products[$event->getProductData()->getId()] = CartProduct::createFromArray([
                'product'  => $event->getProductData()->serialize(),
                'quantity' => (int)getenv('DEFAULT_ADD_PRODUCT_QTY')
            ]);
        }

        $this->productsQuantity++;
        $this->value += $event->getProductData()->getPrice();
    }

    public function onCartProductDeleted(CartProductDeleted $event): void
    {
        if (isset($this->products[$event->getProductId()])) {
            $this->value -= $this->products[$event->getProductId()]->getProductData()->getPrice();
            unset($this->products[$event->getProductId()]);
        } else {
            throw new CartProductNotFound($event->getProductId());
        }
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

    private function doesExceedMaxItems(): bool
    {
        if ($this->productsQuantity >= (int)getenv('MAX_ITEMS_IN_BASKET')) {
            return true;
        }
        return false;
    }

    private function doesExceedMaxQuantityOfProduct(string $name): bool
    {
        foreach ($this->products as $productKey => $product) {
            if ($product->getProductData()->getName() === $name && $product->getQuantity() >= (int)getenv('MAX_PRODUCT_QTY_IN_BASKET')) {
                return true;
            }
        }

        return false;
    }
}
