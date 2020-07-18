<?php

declare(strict_types=1);

namespace App\Application\DTO;

use App\Application\DTO\Factory\ProductUpdateRequestDTOFactory;

class ProductUpdateRequestDTO
{
    use ProductUpdateRequestDTOFactory;

    private const LABEL_NAME = 'name';
    private const LABEL_PRICE = 'price';

    private string $id;
    private ?string $name;
    private ?float $price;

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function serialize(): array
    {
        $output = [];

        if ($this->name) {
            $output[self::LABEL_NAME] = $this->name;
        }

        if ($this->price) {
            $output[self::LABEL_PRICE] = $this->price;
        }

        return $output;
    }
}
