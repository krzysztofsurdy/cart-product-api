<?php
declare(strict_types=1);

namespace App\Cart\Application\DTO;

use App\Cart\Application\DTO\Factory\DeleteCartProductRequestDTOFactory;

class DeleteCartProductRequestDTO
{
    use DeleteCartProductRequestDTOFactory;

    private string $cartId;
    private string $productId;

    public function getCartId(): string
    {
        return $this->cartId;
    }

    public function getProductId(): string
    {
        return $this->productId;
    }
}
