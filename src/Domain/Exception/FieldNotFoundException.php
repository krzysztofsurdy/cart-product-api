<?php

declare(strict_types=1);

namespace App\Domain\Exception;

use App\SharedKernel\Exception\ApiException;

class FieldNotFoundException extends ApiException
{
    public function __construct(string $className, string $fieldName)
    {
        parent::__construct("Field $fieldName was not found in $className.");
    }
}
