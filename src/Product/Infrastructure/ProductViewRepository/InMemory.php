<?php
declare(strict_types=1);

namespace App\Product\Infrastructure\ProductViewRepository;

use App\Product\Domain\Exception\ProductWithNameAlreadyExistsException;
use App\Product\Domain\Product;
use App\Product\Domain\ProductData;
use App\Product\Infrastructure\Exception\ProductNotFoundException;
use App\Product\Infrastructure\ProductViewRepositoryInterface;
use App\SharedKernel\Dictionary\DateFormat;
use DateTimeInterface;

final class InMemory implements ProductViewRepositoryInterface
{
    private array $memory = [];

    public function get(int $page, int $limit): array
    {
        return $this->memory;
    }

    public function total(): int
    {
        return count($this->memory);
    }


    public function getByName(string $name): ?array
    {
        foreach ($this->memory as $product) {
            if ($product[Product::LABEL_NAME] === $name) {
                return $product;
            }
        }

        throw new ProductNotFoundException($name);
    }

    public function add(string $id, ProductData $productData, DateTimeInterface $createdAt): void
    {
        foreach ($this->memory as $product) {
            if ($product[Product::LABEL_NAME] === $productData->getName()) {
                throw new ProductWithNameAlreadyExistsException($productData->getName());
            }
        }

        $this->memory[$id] = [
            array_merge(
                $productData->serialize(),
                [
                    Product::LABEL_CREATED_AT => $createdAt->format(DateFormat::DEFAULT),
                    Product::LABEL_DELETED_AT => null
                ]
            )
        ];
    }

    public function markDeleted(string $id, DateTimeInterface $deletedAt): void
    {
        if (!isset($this->memory[$id])) {
            throw new ProductNotFoundException($id);
        }

        $this->memory[$id][Product::LABEL_DELETED_AT] = $deletedAt->format(DateFormat::DEFAULT);
    }


    public function changeName(string $id, string $name): void
    {
        if (!isset($this->memory[$id])) {
            throw new ProductNotFoundException($id);
        }

        $this->memory[$id][Product::LABEL_NAME] = $name;
    }

    public function changePrice(string $id, float $price): void
    {
        if (!isset($this->memory[$id])) {
            throw new ProductNotFoundException($id);
        }

        $this->memory[$id][Product::LABEL_PRICE] = $price;
    }
}
