<?php
declare(strict_types=1);

namespace App\Infrastructure\Exception;

use App\SharedKernel\Exception\ApiException;

class InstanceOfInvalidClassAggregatedException extends ApiException
{
    public function __construct()
    {
        parent::__construct('Instance of invalid class aggregated in event store.');
    }
}
