<?php
declare(strict_types=1);

namespace App\Infrastructure\ProductViewRepository;

use App\Domain\ProductData;
use App\Infrastructure\ProductViewRepositoryInterface;
use DateTimeInterface;

class InMemory implements ProductViewRepositoryInterface
{
    public function get(string $id): array
    {
        // TODO: Implement get() method.
    }

    public function getByName(string $name): ?array
    {
        // TODO: Implement getByName() method.
    }

    public function add(string $id, ProductData $productData, DateTimeInterface $createdAt): void
    {
        // TODO: Implement add() method.
    }

    public function markDeleted(string $id, DateTimeInterface $deletedAt): void
    {
        // TODO: Implement markDeleted() method.
    }


    public function changeName(string $id, string $name): void
    {
        // TODO: Implement changeName() method.
    }

    public function changePrice(string $id, float $price): void
    {
        // TODO: Implement changePrice() method.
    }
}
