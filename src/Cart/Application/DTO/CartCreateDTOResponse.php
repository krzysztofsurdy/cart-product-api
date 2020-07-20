<?php
declare(strict_types=1);

namespace App\Cart\Application\DTO;

use JsonSerializable;

class CartCreateDTOResponse implements JsonSerializable
{
    private string $id;

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id
        ];
    }
}
