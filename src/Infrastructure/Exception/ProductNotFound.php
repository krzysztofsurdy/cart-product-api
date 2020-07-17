<?php

declare(strict_types=1);

namespace App\Infrastructure\Exception;

use App\SharedKernel\Exception\ApiException;

class ProductNotFound extends ApiException
{
    public function __construct(string $id)
    {
        parent::__construct("Product with ID $id was not found.");
    }
}
