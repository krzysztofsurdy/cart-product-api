<?php

declare(strict_types=1);

namespace App\Product\Domain\Exception;

use App\SharedKernel\Exception\ApiException;

final class FieldNotFoundException extends ApiException
{
    public function __construct(string $className, string $fieldName)
    {
        parent::__construct("Field $fieldName was not found in $className.");
    }
}
