<?php

declare(strict_types=1);

namespace App\Tests\Unit\Product\Domain;

use App\Product\Domain\Product;
use App\Product\Domain\ProductData;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class ProductTest extends TestCase
{
    public function test_can_create(): void
    {
        // When
        $product = $this->createProduct('test-name', 12.32);

        // Then
        $this->assertEquals('test-name', $product->getName());
        $this->assertEquals(12.32, $product->getPrice());
        $this->assertNotEmpty($product->getId());
    }

    public function test_can_delete(): void
    {
        // Given
        $product = $this->createProduct('test-delete-name', 15.32);

        // Then
        $this->assertNull($product->getDeletedAt());

        // When
        $product->delete();

        // Them
        $this->assertInstanceOf(\DateTimeInterface::class, $product->getDeletedAt());
        $this->assertNotNull($product->getDeletedAt());
    }

    public function test_can_change_price(): void
    {
        // Given
        $product = $this->createProduct('test-can-change-price', 32.12);

        // When
        $product->changePrice(123000.23);

        // Then
        $this->assertEquals(123000.23, $product->getPrice());
    }

    public function test_can_change_name(): void
    {
        // Given
        $product = $this->createProduct('test-can-change-name', 12.12);

        // When
        $product->changeName('name-changed');

        // Then
        $this->assertEquals('name-changed', $product->getName());
    }

    public function test_can_serialize(): void
    {
        // Given
        $product = $this->createProduct('serializable', 33.33);
        $product->delete();

        // When
        $serialized = $product->jsonSerialize();

        // Then
        $this->assertEquals('serializable', $serialized[Product::LABEL_NAME]);
        $this->assertEquals(33.33, $serialized[Product::LABEL_PRICE]);
        $this->assertNotEmpty($serialized[Product::LABEL_ID]);
        $this->assertNotEmpty($serialized[Product::LABEL_CREATED_AT]);
        $this->assertNotEmpty($serialized[Product::LABEL_DELETED_AT]);
    }

    private function createProduct(string $name, float $price): Product
    {
        $productData = ProductData::createFromArray([
            'name'  => $name,
            'price' => $price,
            'id'    => $id = Uuid::uuid1()->toString()
        ]);

        return Product::create($productData);
    }
}
