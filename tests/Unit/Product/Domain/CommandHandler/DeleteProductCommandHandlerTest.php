<?php

declare(strict_types=1);

namespace App\Tests\Unit\Product\Domain\CommandHandler;

use App\Product\Application\Command\AddProductCommand;
use App\Product\Application\Command\DeleteProductCommand;
use App\Product\Domain\CommandHandler\AddProductCommandHandler;
use App\Product\Domain\CommandHandler\DeleteProductCommandHandler;
use App\Product\Infrastructure\ProductRepository\InMemory as ProductRepository;
use App\Product\Infrastructure\ProductViewRepository\InMemory as ProductViewRepository;
use PHPUnit\Framework\TestCase;

class DeleteProductCommandHandlerTest extends TestCase
{
    private ProductRepository $productRepository;
    private ProductViewRepository $productViewRepository;

    public function setUp(): void
    {
        $this->productRepository = new ProductRepository();
        $this->productViewRepository = new ProductViewRepository();
    }

    public function test_can_delete(): void
    {
        // Given
        $this->createProduct();

        $command = new DeleteProductCommand('test-id');
        $handler = new DeleteProductCommandHandler($this->productRepository);

        // When
        $handler($command);

        // Then
        $product = $this->productRepository->get('test-id');
        $this->assertInstanceOf(\DateTimeInterface::class, $product->getDeletedAt());
    }

    private function createProduct(): void
    {
        $command = new AddProductCommand('test-id', 'test-name', 32.12);
        $handler = new AddProductCommandHandler($this->productRepository, $this->productViewRepository);

        $handler($command);
    }
}
