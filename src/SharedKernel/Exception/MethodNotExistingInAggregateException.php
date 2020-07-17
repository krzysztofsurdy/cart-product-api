<?php

declare(strict_types=1);

namespace App\SharedKernel\Exception;

class MethodNotExistingInAggregateException extends ApiException
{
    public function __construct(string $className, string $methodName)
    {
        parent::__construct("Method $methodName not existing in object $className.");
    }
}
