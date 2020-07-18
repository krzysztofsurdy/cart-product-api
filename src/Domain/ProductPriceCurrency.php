<?php

declare(strict_types=1);

namespace App\Domain;

use App\Domain\Factory\ProductPriceCurrencyFactory;
use JsonSerializable;

class ProductPriceCurrency implements JsonSerializable
{
    use ProductPriceCurrencyFactory;

    public const LABEL_ID = 'id';
    public const LABEL_NAME = 'name';

    private int $id;
    private string $name;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function jsonSerialize()
    {
        return [
            self::LABEL_ID => $this->id,
            self::LABEL_NAME => $this->name,
        ];
    }
}
