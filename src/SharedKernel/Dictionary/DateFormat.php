<?php

declare(strict_types=1);

namespace App\SharedKernel\Dictionary;

use DateTimeInterface;

interface DateFormat extends DateTimeInterface
{
    public const DEFAULT = 'Y-m-d H:i:s';
}
