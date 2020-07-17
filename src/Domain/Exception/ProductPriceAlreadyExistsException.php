<?php

declare(strict_types=1);

namespace App\Domain\Exception;

use App\SharedKernel\Exception\ApiException;

class ProductPriceAlreadyExistsException extends ApiException
{
    public function __construct(string $currencyName)
    {
        parent::__construct("ProductPrice for currency $currencyName already exists.");
    }
}
