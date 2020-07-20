<?php

declare(strict_types=1);

namespace App\SharedKernel\Compare;

use App\SharedKernel\Aggregate\AggregateRootDataInterface;

interface ComparerInterface
{
    public function compare(AggregateRootDataInterface $aggregateRootData): void;
}
