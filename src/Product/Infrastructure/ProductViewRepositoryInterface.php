<?php
declare(strict_types=1);

namespace App\Product\Infrastructure;

use App\Product\Domain\ProductData;
use DateTimeInterface;

interface ProductViewRepositoryInterface
{
    public function get(int $page, int $limit): array;
    public function total(): int;
    public function getByName(string $name): ?array;
    public function add(string $id, ProductData $productData, DateTimeInterface $createdAt): void;
    public function markDeleted(string $id, DateTimeInterface $deletedAt): void;
    public function changeName(string $id, string $name): void;
    public function changePrice(string $id, float $price): void;
}
