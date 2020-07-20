<?php
declare(strict_types=1);

namespace App\Cart\Application\DTO;

use App\Cart\Application\DTO\Factory\CartCreateResponseDTOFactory;
use App\Cart\Domain\Cart;
use JsonSerializable;

class CartCreateResponseDTO implements JsonSerializable
{
    use CartCreateResponseDTOFactory;

    private string $id;

    public function jsonSerialize(): array
    {
        return [
            Cart::LABEL_ID => $this->id
        ];
    }
}
