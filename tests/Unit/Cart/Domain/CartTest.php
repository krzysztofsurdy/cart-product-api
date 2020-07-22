<?php
declare(strict_types=1);

namespace App\Tests\Unit\Cart\Domain;

use App\Cart\Domain\Cart;
use App\Cart\Domain\Exception\CartProductNotFound;
use App\Cart\Domain\Exception\ProductQuantityInBasketExceedException;
use App\Cart\Domain\Exception\ProductsInBasketExceedException;
use App\Product\Domain\ProductData;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class CartTest extends TestCase
{
    public function test_can_create(): void
    {
        // Given
        $id = Uuid::uuid1()->toString();

        // When
        $cart = Cart::build($id);

        // Then
        $this->assertEquals($id, $cart->getId());
        $this->assertEquals(0, $cart->getValue());
        $this->assertEquals(0, $cart->getProductsQuantity());
    }

    public function test_can_add_product(): void
    {
        // Given
        $id = Uuid::uuid1()->toString();
        $cart = Cart::build($id);
        $name = 'test';
        $price = 21.36;

        // When
        $cart->addProduct($this->createProductData($name, $price));

        // Then
        $this->assertCount(1, $cart->getProducts());
    }

    public function test_can_delete_product(): void
    {
        // Given
        $id = Uuid::uuid1()->toString();
        $cart = Cart::build($id);
        $name = 'test';
        $price = 21.36;
        $product = $this->createProductData($name, $price);
        $cart->addProduct($product);

        // When
        $cart->deleteProduct($product->getId());

        // Then
        $this->assertCount(0, $cart->getProducts());
    }

    public function test_will_throw_error_if_too_many_products_in_cart(): void
    {
        // Expect
        $this->expectException(ProductsInBasketExceedException::class);
        // Given
        $id = Uuid::uuid1()->toString();
        $cart = Cart::build($id);
        $price = 21.36;

        // When
        $counter = 0;
        while ($counter < 12) {
            $cart->addProduct($this->createProductData(Uuid::uuid1()->toString(), $price));
            $counter++;
        }
    }

    public function test_will_throw_error_if_too_many_of_one_product_in_cart(): void
    {
        // Expect
        $this->expectException(ProductQuantityInBasketExceedException::class);
        // Given
        $id = Uuid::uuid1()->toString();
        $cart = Cart::build($id);
        $price = 21.36;

        // When
        $counter = 0;
        while ($counter < 10) {
            $cart->addProduct($this->createProductData($id, $price));
            $counter++;
        }
    }

    public function test_will_throw_error_if_try_to_delete_product_not_in_cart(): void
    {
        // Expect
        $this->expectException(CartProductNotFound::class);
        // Given
        $id = Uuid::uuid1()->toString();
        $cart = Cart::build($id);


        // When
        $counter = 0;
        while ($counter < 10) {
            $cart->deleteProduct(Uuid::uuid1()->toString());
            $counter++;
        }
    }

    public function test_can_serialize(): void
    {
        // Given
        $id = Uuid::uuid1()->toString();
        $cart = Cart::build($id);
        $name = 'test';
        $price = 21.36;
        $product = $this->createProductData($name, $price);
        $cart->addProduct($product);

        // When
        $serialized = $cart->jsonSerialize();

        // Then
        $this->assertNotEmpty($serialized[Cart::LABEL_ID]);
        $this->assertNotEmpty($serialized[Cart::LABEL_PRODUCTS]);
        $this->assertNotEmpty($serialized[Cart::LABEL_PRODUCTS_QUANTITY]);
        $this->assertNotEmpty($serialized[Cart::LABEL_VALUE]);
        $this->assertIsArray($serialized[Cart::LABEL_PRODUCTS]);
        $this->assertEquals($id, $serialized[Cart::LABEL_ID]);
        $this->assertEquals(1, $serialized[Cart::LABEL_PRODUCTS_QUANTITY]);
        $this->assertEquals($price, $serialized[Cart::LABEL_VALUE]);
    }

    public function test_can_unserialize(): void
    {
        // Given
        $id = Uuid::uuid1()->toString();
        $cart = Cart::build($id);
        $name = 'test';
        $price = 21.36;
        $product = $this->createProductData($name, $price);
        $cart->addProduct($product);
        $serialized = $cart->jsonSerialize();

        // When
        $unserialized = Cart::createFromArray($serialized);

        // Then
        $this->assertEquals($id, $unserialized->getId());
        $this->assertEquals($price, $unserialized->getValue());
        $this->assertEquals(1, $unserialized->getProductsQuantity());
    }

    private function createProductData(string $name, float $price): ProductData
    {
        return ProductData::createFromArray([
            'name'  => $name,
            'price' => $price,
            'id'    => $id = Uuid::uuid1()->toString()
        ]);
    }
}
