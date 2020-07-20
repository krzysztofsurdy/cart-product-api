<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\Exception;

use App\SharedKernel\Exception\ApiException;

final class ProductNotFoundException extends ApiException
{
    public function __construct(string $id)
    {
        parent::__construct("Product with ID $id was not found.");
    }
}
