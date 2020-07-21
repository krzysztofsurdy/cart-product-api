<?php
declare(strict_types=1);

namespace App\Cart\Application\DTO;

use App\Cart\Application\DTO\Factory\CartCreateResponseDTOFactory;
use App\Cart\Domain\Cart;
use JsonSerializable;

final class CartCreateResponseDTO implements JsonSerializable
{
    use CartCreateResponseDTOFactory;

    public const LABEL_ID = 'id';

    private string $id;

    public function jsonSerialize(): array
    {
        return [
            Cart::LABEL_ID => $this->id
        ];
    }
}
