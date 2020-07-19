<?php
declare(strict_types=1);

namespace App\Tests\Application\Command;

use App\Application\Command\UpdateProductCommand;
use App\Domain\Product;
use App\Domain\ProductData;
use PHPUnit\Framework\TestCase;

class UpdateProductCommandTest extends TestCase
{
    /**
     * @dataProvider getTestCases
     */
    public function testShouldCreateUpdateProductCommand(string $id, ProductData $productData): void
    {
        // When
        $command = new UpdateProductCommand($id, $productData);

        // Then
        $this->assertIsString($command->getId());
        $this->assertEquals($id, $command->getId());
    }

    public function getTestCases(): array
    {
        return [
            [
                'test',
                ProductData::createFromArray([
                    Product::LABEL_NAME => 'test'
                ])
            ]
        ];
    }
}
