<?php

declare(strict_types=1);

namespace App\Tests\Unit\Product\Domain\CommandHandler;

use App\Product\Application\Command\AddProductCommand;
use App\Product\Domain\CommandHandler\AddProductCommandHandler;
use App\Product\Infrastructure\ProductRepository\InMemory as ProductRepository;
use App\Product\Infrastructure\ProductViewRepository\InMemory as ProductViewRepository;
use PHPUnit\Framework\TestCase;

class AddProductCommandHandlerTest extends TestCase
{
    /**
     * @dataProvider productProvider
     */
    public function test_can_add_product(string $id, string $name, float $price): void
    {
        // Given
        $productRepository = new ProductRepository();
        $productViewRepository = new ProductViewRepository();

        $handler = new AddProductCommandHandler($productRepository, $productViewRepository);
        $command = new AddProductCommand($id, $name, $price);

        // When
        $handler($command);

        // Then
        $product = $productRepository->get($id);

        $this->assertEquals($name, $product->getName());
        $this->assertEquals($price, $product->getPrice());
        $this->assertEquals($id, $product->getId());
    }

    public function productProvider(): array
    {
        return [
            ['3', 'first-product', 33.94],
            ['4', 'second-product', 3.43],
            ['12', 'product', 43.1],
            ['5', 'daw-product', 3.12],
            ['4', 'acaw-product', 0.01],
            ['32', 'dwadw-product', 92.55],
        ];
    }
}
