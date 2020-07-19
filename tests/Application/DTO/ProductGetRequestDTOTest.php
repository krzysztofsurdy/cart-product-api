<?php
declare(strict_types=1);

namespace App\Tests\Application\DTO;

use App\Application\DTO\ProductGetRequestDTO;
use PHPUnit\Framework\TestCase;

class ProductGetRequestDTOTest extends TestCase
{
    /**
     * @dataProvider getTestCases
     */
    public function testShouldCreateProductGetRequestDTO(array $data): void
    {
        // When
        $dto = ProductGetRequestDTO::createFromArray($data);

        // Then
        $this->assertEquals($data[ProductGetRequestDTO::LABEL_PAGE], $dto->getPage());
        $this->assertEquals($data[ProductGetRequestDTO::LABEL_LIMIT], $dto->getLimit());
    }

    public function getTestCases(): array
    {
        return [
            [
                [
                    ProductGetRequestDTO::LABEL_PAGE => 1,
                    ProductGetRequestDTO::LABEL_LIMIT => 1,
                ]
            ]
        ];
    }
}
