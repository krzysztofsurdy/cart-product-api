<?php
declare(strict_types=1);

namespace App\Cart\Application\Command;

use App\Product\Domain\ProductData;

final class AddCartProductCommand
{
    private string $cartId;
    private ProductData $productData;

    public function __construct(string $cartId, ProductData $productData)
    {
        $this->cartId = $cartId;
        $this->productData = $productData;
    }

    public function getCartId(): string
    {
        return $this->cartId;
    }

    public function getProductData(): ProductData
    {
        return $this->productData;
    }
}
