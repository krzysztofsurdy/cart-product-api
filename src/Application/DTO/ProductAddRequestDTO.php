<?php

declare(strict_types=1);

namespace App\Application\DTO;

use App\Application\DTO\Factory\ProductAddRequestDTOFactory;

class ProductAddRequestDTO
{
    use ProductAddRequestDTOFactory;

    private string $name;
    private float $price;

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}
