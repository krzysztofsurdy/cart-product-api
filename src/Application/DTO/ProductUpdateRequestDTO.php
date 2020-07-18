<?php

declare(strict_types=1);

namespace App\Application\DTO;

use App\Application\DTO\Factory\ProductUpdateRequestDTOFactory;

class ProductUpdateRequestDTO
{
    use ProductUpdateRequestDTOFactory;

    private const LABEL_NAME = 'name';
    private const LABEL_PRICES = 'prices';

    private string $id;
    private ?string $name;
    private ?array $prices;

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getPrices(): ?array
    {
        return $this->prices;
    }

    public function serialize(): array
    {
        $output = [];

        if ($this->name) {
            $output[self::LABEL_NAME] = $this->name;
        }

        if ($this->prices) {
            $output[self::LABEL_PRICES] = $this->prices;
        }

        return $output;
    }
}
