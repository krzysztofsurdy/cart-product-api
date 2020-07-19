<?php

declare(strict_types=1);

namespace App\SharedKernel\Exception;

final class FieldNotFoundException extends ApiException
{
    public function __construct(string $className, string $fieldName)
    {
        parent::__construct("Field $fieldName was not found in $className.");
    }
}
