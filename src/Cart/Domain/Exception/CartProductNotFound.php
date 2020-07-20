<?php
declare(strict_types=1);

namespace App\Cart\Domain\Exception;

use App\SharedKernel\Exception\ApiException;

class CartProductNotFound extends ApiException
{
    public function __construct(string $productId)
    {
        parent::__construct("Product $productId not found in basket");
    }
}
