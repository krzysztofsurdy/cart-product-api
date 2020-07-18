<?php

declare(strict_types=1);

namespace App\Application\DTO;

use App\Application\DTO\Factory\ProductAddRequestDTOFactory;

class ProductAddRequestDTO
{
    use ProductAddRequestDTOFactory;

    private string $name;
    private array $prices;

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrices(): array
    {
        return $this->prices;
    }
}
