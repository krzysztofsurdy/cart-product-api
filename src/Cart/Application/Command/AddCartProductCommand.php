<?php
declare(strict_types=1);

namespace App\Cart\Application\Command;

use App\Product\Domain\Product;

class AddCartProductCommand
{
    private string $cartId;
    private Product $product;

    public function __construct(string $cartId, Product $product)
    {
        $this->cartId = $cartId;
        $this->product = $product;
    }

    public function getCartId(): string
    {
        return $this->cartId;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }
}
