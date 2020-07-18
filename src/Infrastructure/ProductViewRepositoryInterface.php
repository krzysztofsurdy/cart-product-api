<?php
declare(strict_types=1);

namespace App\Infrastructure;

use App\Domain\ProductData;
use DateTimeInterface;

interface ProductViewRepositoryInterface
{
    public function get(string $id): array;
    public function getByName(string $name): ?array;
    public function add(string $id, ProductData $productData, DateTimeInterface $createdAt): void;
    public function markDeleted(string $id, DateTimeInterface $deletedAt): void;
    public function changeName(string $id, string $name): void;
    public function changePrice(string $id, float $price): void;
}
