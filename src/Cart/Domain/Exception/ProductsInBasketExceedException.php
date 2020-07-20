<?php
declare(strict_types=1);

namespace App\Cart\Domain\Exception;

use App\SharedKernel\Exception\ApiException;

class ProductsInBasketExceedException extends ApiException
{
    public function __construct()
    {
        $maxInBasket = (int)getenv('MAX_ITEMS_IN_BASKET');
        parent::__construct("Exceeded number of items in basket of $maxInBasket");
    }
}
