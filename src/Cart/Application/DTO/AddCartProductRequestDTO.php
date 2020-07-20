<?php
declare(strict_types=1);

namespace App\Cart\Application\DTO;

use App\Product\Domain\Product;

class AddCartProductRequestDTO
{
    public const LABEL_PRODUCT = 'product';

    private string $cartId;
    private Product $product;

    public function getCartId(): string
    {
        return $this->cartId;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }
}
