<?php
declare(strict_types=1);

namespace App\Tests\Unit\Cart\Domain;

use App\Cart\Domain\CartProduct;

use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class CartProductTest extends TestCase
{
    public function test_can_create(): void
    {
        // Given
        $name = 'test';
        $price = 21.36;
        $quantity = 18;

        // When
        $cartProduct = $this->createCartProduct($name, $price, $quantity);

        // Then
        $this->assertEquals($quantity, $cartProduct->getQuantity());
        $this->assertNotEmpty($cartProduct->getProductData());
    }

    public function test_can_increment_quantity(): void
    {
        // Given
        $name = 'test';
        $price = 21.36;
        $quantity = 18;
        $cartProduct = $this->createCartProduct($name, $price, $quantity);

        // When
        $cartProduct->incrementQuantity();

        // Then
        $this->assertEquals($quantity+1, $cartProduct->getQuantity());
    }

    public function test_can_serialize(): void
    {
        // Given
        $name = 'test';
        $price = 21.36;
        $quantity = 18;
        $cartProduct = $this->createCartProduct($name, $price, $quantity);

        // When
        $serialized = $cartProduct->jsonSerialize();

        // Then
        $this->assertNotEmpty($serialized[CartProduct::LABEL_QUANTITY]);
        $this->assertNotEmpty($serialized[CartProduct::LABEL_PRODUCT]);
        $this->assertEquals($quantity, $serialized[CartProduct::LABEL_QUANTITY]);
    }

    public function test_can_unserialize(): void
    {
        // Given
        $name = 'test';
        $price = 21.36;
        $quantity = 18;
        $cartProduct = $this->createCartProduct($name, $price, $quantity);
        $serialized = $cartProduct->jsonSerialize();

        // When
        $unserialized = CartProduct::createFromArray($serialized);

        // Then
        $this->assertEquals($quantity, $unserialized->getQuantity());
    }

    private function createCartProduct(string $name, float $price, int $quantity): CartProduct
    {
        return CartProduct::createFromArray([
            'product' => [
                'name'  => $name,
                'price' => $price,
                'id'    => $id = Uuid::uuid1()->toString()
            ],
            'quantity' => $quantity
        ]);
    }
}
