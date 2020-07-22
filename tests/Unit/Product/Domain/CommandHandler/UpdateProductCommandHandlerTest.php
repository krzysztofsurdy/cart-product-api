<?php

declare(strict_types=1);

namespace App\Tests\Unit\Product\Domain\CommandHandler;

use App\Product\Application\Command\AddProductCommand;
use App\Product\Application\Command\UpdateProductCommand;
use App\Product\Domain\CommandHandler\AddProductCommandHandler;
use App\Product\Domain\CommandHandler\UpdateProductCommandHandler;
use App\Product\Domain\ProductData;
use App\Product\Infrastructure\ProductRepository\InMemory as ProductRepository;
use App\Product\Infrastructure\ProductViewRepository\InMemory as ProductViewRepository;
use PHPUnit\Framework\TestCase;

class UpdateProductCommandHandlerTest extends TestCase
{
    private ProductRepository $productRepository;
    private ProductViewRepository $productViewRepository;

    public function setUp(): void
    {
        $this->productRepository = new ProductRepository();
        $this->productViewRepository = new ProductViewRepository();
    }

    public function test_can_update_product(): void
    {
        // Given
        $this->createProduct();
        $name = 'after update';
        $price = 13.13;

        $command = new UpdateProductCommand('test-id', ProductData::createFromArray([
            'name' => $name,
            'price' => $price
        ]));
        $handler = new UpdateProductCommandHandler($this->productRepository, $this->productViewRepository);

        // When
        $handler($command);

        // Then
        $product = $this->productRepository->get('test-id');

        $this->assertEquals($name, $product->getName());
        $this->assertEquals($price, $product->getPrice());
    }

    private function createProduct(): void
    {
        $command = new AddProductCommand('test-id', 'test-name', 32.12);
        $handler = new AddProductCommandHandler($this->productRepository, $this->productViewRepository);

        $handler($command);
    }
}
