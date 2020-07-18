<?php

declare(strict_types=1);

namespace App\Application\DTO;

use App\Application\DTO\Factory\ProductGetRequestDTOFactory;

class ProductGetRequestDTO
{
    use ProductGetRequestDTOFactory;

    private string $id;

    public function getId(): string
    {
        return $this->id;
    }
}
