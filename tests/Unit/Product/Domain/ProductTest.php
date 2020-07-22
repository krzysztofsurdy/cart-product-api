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
        // Given
        $name = 'test-name';
        $price = 12.32;
        // When
        $product = $this->createProduct($name, $price);

        // Then
        $this->assertEquals($name, $product->getName());
        $this->assertEquals($price, $product->getPrice());
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
        $newPrice = 123000.23;

        // When
        $product->changePrice($newPrice);

        // Then
        $this->assertEquals($newPrice, $product->getPrice());
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
        $name = 'serializable';
        $price = 33.33;
        $product = $this->createProduct($name, $price);
        $product->delete();

        // When
        $serialized = $product->jsonSerialize();

        // Then
        $this->assertNotEmpty($serialized[Product::LABEL_ID]);
        $this->assertNotEmpty($serialized[Product::LABEL_CREATED_AT]);
        $this->assertNotEmpty($serialized[Product::LABEL_DELETED_AT]);
        $this->assertEquals($name, $serialized[Product::LABEL_NAME]);
        $this->assertEquals($price, $serialized[Product::LABEL_PRICE]);
    }

    public function test_can_unserialize(): void
    {
        // Given
        $name = 'serializable';
        $price = 33.33;
        $product = $this->createProduct($name, $price);
        $product->delete();
        $serialized = $product->jsonSerialize();


        // When
        $unserialized = Product::create(ProductData::createFromArray($serialized));

        // Then
        $this->assertEquals($product->getId(), $unserialized->getId());
        $this->assertEquals($product->getName(), $unserialized->getName());
        $this->assertEquals($product->getPrice(), $unserialized->getPrice());
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
