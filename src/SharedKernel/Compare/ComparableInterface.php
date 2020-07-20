<?php

declare(strict_types=1);

namespace App\SharedKernel\Compare;

interface ComparableInterface
{
    public function getComparer(): ComparerInterface;
}
