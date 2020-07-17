<?php
declare(strict_types=1);

namespace App\Application\Command;

use App\Domain\ProductPrice;

final class AddProductCommand
{
    private string $title;
    /** @var ProductPrice[] */
    private array $prices;

    public function __construct(string $title, $prices)
    {
        $this->title = $title;
        $this->prices = $prices;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getPrices(): array
    {
        return $this->prices;
    }
}
