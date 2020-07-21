<?php
declare(strict_types=1);

namespace App\Cart\Domain\Exception;

use App\SharedKernel\Exception\ApiException;

final class CartNotFoundException extends ApiException
{
    public function __construct(string $id)
    {
        parent::__construct("Cart with ID $id was not found.");
    }
}
