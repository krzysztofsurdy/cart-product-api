<?php
declare(strict_types=1);

namespace App\Product\Domain\Exception;

use App\SharedKernel\Exception\ApiException;

final class ProductWithNameAlreadyExistsException extends ApiException
{
    public function __construct(string $name)
    {
        parent::__construct("Product with name $name already exists.");
    }
}
