<?php
declare(strict_types=1);

namespace App\Cart\Infrastructure\CartRepository;

use App\Cart\Domain\Cart;
use App\Cart\Infrastructure\CartRepositoryInterface;
use Predis\ClientInterface;

class Redis implements CartRepositoryInterface
{
    private ClientInterface $redis;

    public function create(Cart $cart): void
    {
        $this->redis->set($cart->getId(), $cart->jsonSerialize());
    }

    public function get(string $id): array
    {
        return [];
    }
}
