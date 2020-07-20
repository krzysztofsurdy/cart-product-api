<?php

declare(strict_types=1);

namespace App\Product\Application\DTO;

use App\Product\Application\DTO\Factory\ProductUpdateRequestDTOFactory;
use App\Product\Domain\Product;

final class ProductUpdateRequestDTO
{
    use ProductUpdateRequestDTOFactory;

    private string $id;
    private ?string $name = null;
    private ?float $price = null;

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function serialize(): array
    {
        $output = [];

        if ($this->name) {
            $output[Product::LABEL_NAME] = $this->name;
        }

        if ($this->price) {
            $output[Product::LABEL_PRICE] = $this->price;
        }

        return $output;
    }
}
