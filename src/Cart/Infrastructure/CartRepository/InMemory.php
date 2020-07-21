<?php
declare(strict_types=1);

namespace App\Cart\Infrastructure\CartRepository;

use App\Cart\Domain\Cart;
use App\Cart\Infrastructure\CartRepositoryInterface;

final class InMemory implements CartRepositoryInterface
{
    private array $memory = [];

    public function save(Cart $cart): void
    {
        $this->memory[$cart->getId()] = $cart->jsonSerialize();
    }

    public function get(string $id): array
    {
        if (!isset($this->memory[$id])) {
            return $this->memory[$id];
        }

        return [];
    }
}
