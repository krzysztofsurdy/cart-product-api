<?php

declare(strict_types=1);

namespace App\Domain;

interface ComparableInterface
{
    public function getComparer(): ComparerInterface;
}
