<?php
declare(strict_types=1);

namespace App\Cart\Domain;

use App\Domain\Event\CartCreated;
use App\SharedKernel\Aggregate\AggregateRootApply;
use Ramsey\Uuid\Uuid;

class Cart
{
    use AggregateRootApply;

    private string $id;
    private array $products = [];
    private float $totalValue = 0;
    private float $productsQuantity = 0;
    
    public function create(): Cart
    {
        $cart = new self;
        $this->apply(CartCreated::createFor());
    }
}
