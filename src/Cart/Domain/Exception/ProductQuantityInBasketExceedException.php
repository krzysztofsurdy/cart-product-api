<?php
declare(strict_types=1);

namespace App\Cart\Domain\Exception;

use App\SharedKernel\Exception\ApiException;

final class ProductQuantityInBasketExceedException extends ApiException
{
    public function __construct()
    {
        $maxInBasket = (int)getenv('MAX_PRODUCT_QTY_IN_BASKET');
        parent::__construct("Exceeded quantity of $maxInBasket");
    }
}
