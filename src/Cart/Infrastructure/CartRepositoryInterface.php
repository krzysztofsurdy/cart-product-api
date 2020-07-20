<?php
declare(strict_types=1);

namespace App\Cart\Infrastructure;

use App\Cart\Domain\Cart;

interface CartRepositoryInterface
{
    public function save(Cart $cart): void;
    public function get(string $id): array;
}
