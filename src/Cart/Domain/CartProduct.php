<?php
declare(strict_types=1);

namespace App\Cart\Domain;

use App\Cart\Domain\Factory\CartProductFactory;
use App\Product\Domain\ProductData;
use JsonSerializable;

final class CartProduct implements JsonSerializable
{
    use CartProductFactory;

    public const LABEL_PRODUCT = 'product';
    public const LABEL_QUANTITY = 'quantity';

    private ProductData $product;
    private int $quantity;

    public function getProductData(): ProductData
    {
        return $this->product;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function incrementQuantity(): void
    {
        $this->quantity++;
    }

    public function jsonSerialize()
    {
        return [
            self::LABEL_PRODUCT  => $this->product->serialize(),
            self::LABEL_QUANTITY => $this->quantity
        ];
    }
}
