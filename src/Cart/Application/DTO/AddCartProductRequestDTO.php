<?php
declare(strict_types=1);

namespace App\Cart\Application\DTO;

use App\Cart\Application\DTO\Factory\AddCartProductRequestDTOFactory;
use App\Product\Domain\ProductData;

class AddCartProductRequestDTO
{
    use AddCartProductRequestDTOFactory;

    private string $cartId;

    private ProductData $productData;

    public function getCartId(): string
    {
        return $this->cartId;
    }

    public function getProductData(): ProductData
    {
        return $this->productData;
    }
}
