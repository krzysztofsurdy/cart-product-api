<?php

declare(strict_types=1);

namespace App\Product\Application\DTO;

use App\Product\Application\DTO\Factory\ProductDeleteRequestDTOFactory;

final class ProductDeleteRequestDTO
{
    use ProductDeleteRequestDTOFactory;

    private string $id;

    public function getId(): string
    {
        return $this->id;
    }
}
