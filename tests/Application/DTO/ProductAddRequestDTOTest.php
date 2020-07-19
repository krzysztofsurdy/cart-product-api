<?php
declare(strict_types=1);

namespace App\Tests\Application\DTO;

use App\Application\DTO\ProductAddRequestDTO;
use App\Domain\Product;
use PHPUnit\Framework\TestCase;

class ProductAddRequestDTOTest extends TestCase
{
    /**
     * @dataProvider getTestCases
     */
    public function testShouldCreateProductAddRequestDTO(array $data): void
    {
        // When
        $dto = ProductAddRequestDTO::createFromArray($data);

        // Then
        $this->assertIsString($dto->getName());
        $this->assertEquals($data[Product::LABEL_NAME], $dto->getName());
        $this->assertIsFloat($dto->getPrice());
        $this->assertEquals($data[Product::LABEL_PRICE], $dto->getPrice());
    }

    public function getTestCases(): array
    {
        return [
            [
                [
                    Product::LABEL_NAME => 'test',
                    Product::LABEL_PRICE => 11.11
                ]
            ]
        ];
    }
}
