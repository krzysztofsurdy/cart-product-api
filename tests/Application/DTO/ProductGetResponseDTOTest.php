<?php
declare(strict_types=1);

namespace App\Tests\Application\DTO;

use App\Application\DTO\ProductGetResponseDTO;
use PHPUnit\Framework\TestCase;

class ProductGetResponseDTOTest extends TestCase
{
    /**
     * @dataProvider getTestCases
     */
    public function testShouldCreateProductGetResponseDTO(array $data): void
    {
        // When
        $dto = ProductGetResponseDTO::createFromArray($data);

        // Then
        $this->assertEquals($data[ProductGetResponseDTO::LABEL_ITEMS], $dto->getItems());
        $this->assertEquals($data[ProductGetResponseDTO::LABEL_ITEMS_TOTAL], $dto->getItemsTotal());
        $this->assertEquals($data[ProductGetResponseDTO::LABEL_PAGE], $dto->getPage());
        $this->assertEquals($data[ProductGetResponseDTO::LABEL_PAGES], $dto->getPages());
        $this->assertEquals($data[ProductGetResponseDTO::LABEL_LIMIT], $dto->getLimit());
    }

    public function getTestCases(): array
    {
        return [
            [
                [
                    ProductGetResponseDTO::LABEL_ITEMS => [],
                    ProductGetResponseDTO::LABEL_ITEMS_TOTAL => 1,
                    ProductGetResponseDTO::LABEL_PAGE => 1,
                    ProductGetResponseDTO::LABEL_PAGES => 1,
                    ProductGetResponseDTO::LABEL_LIMIT => 1,
                ]
            ]
        ];
    }
}
