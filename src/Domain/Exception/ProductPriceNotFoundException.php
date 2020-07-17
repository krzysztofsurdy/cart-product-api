<?php

declare(strict_types=1);

namespace App\Domain\Exception;

use App\SharedKernel\Exception\ApiException;

class ProductPriceNotFoundException extends ApiException
{
    public function __construct(string $currencyName)
    {
        parent::__construct("Price with currency $currencyName was not found.");
    }
}
