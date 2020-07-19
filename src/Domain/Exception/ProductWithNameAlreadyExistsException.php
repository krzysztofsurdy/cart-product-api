<?php
declare(strict_types=1);

namespace App\Domain\Exception;

use App\SharedKernel\Exception\ApiException;

class ProductWithNameAlreadyExistsException extends ApiException
{
    public function __construct(string $name)
    {
        parent::__construct("Product with name $name already exists.");
    }
}
