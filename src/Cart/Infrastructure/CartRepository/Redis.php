<?php
declare(strict_types=1);

namespace App\Cart\Infrastructure\CartRepository;

use App\Cart\Domain\Cart;
use App\Cart\Infrastructure\CartRepositoryInterface;
use Predis\ClientInterface;

final class Redis implements CartRepositoryInterface
{
    private ClientInterface $redis;

    public function __construct(ClientInterface $redis)
    {
        $this->redis = $redis;
    }

    public function save(Cart $cart): void
    {
        $this->redis->set($cart->getId(), json_encode($cart->jsonSerialize()));
    }

    public function get(string $id): array
    {
        $serialized = $this->redis->get($id);

        if (!is_string($serialized)) {
            return [];
        }

        return json_decode($serialized, true);
    }
}
