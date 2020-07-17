<?php
declare(strict_types=1);

namespace App\Domain;

interface Comparer
{
    public function compare(ProductData $productData): void;
}
