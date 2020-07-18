<?php

declare(strict_types=1);

namespace App\Domain;

interface ComparerInterface
{
    public function compare(ProductData $productData): void;
}
