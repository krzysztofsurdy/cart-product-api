<?php
declare(strict_types=1);

namespace App\Cart\Domain\Factory;

use App\Cart\Domain\Cart;
use App\Product\Application\DTO\Decorator\DTODataTypeDecorator;
use App\SharedKernel\Factory\FromArrayFactory;

class CartFactory
{
    use FromArrayFactory;

    public static function createFromArray(array $data): Cart
    {
        $cartProduct = new Cart();

        $data = DTODataTypeDecorator::decorate($data, Cart::LABEL_PRODUCTS_QUANTITY, 'int');
        $data = DTODataTypeDecorator::decorate($data, Cart::LABEL_VALUE, 'float');

        /** @var Cart $cartProduct */
        $cartProduct = self::create($cartProduct, $data);

        return $cartProduct;
    }
}
