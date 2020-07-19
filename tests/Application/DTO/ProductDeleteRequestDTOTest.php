<?php
declare(strict_types=1);

namespace App\Tests\Application\DTO;

use App\Application\DTO\ProductDeleteRequestDTO;
use App\Domain\Product;
use PHPUnit\Framework\TestCase;

class ProductDeleteRequestDTOTest extends TestCase
{
    /**
     * @dataProvider getTestCases
     */
    public function testShouldCreateProductDeleteRequestDTO(array $data): void
    {
        // When
        $dto = ProductDeleteRequestDTO::createFromArray($data);

        // Then
        $this->assertIsString($dto->getId());
        $this->assertEquals($data[Product::LABEL_ID], $dto->getId());
    }

    public function getTestCases(): array
    {
        return [
            [
                [
                    Product::LABEL_ID => 'test'
                ]
            ]
        ];
    }
}
