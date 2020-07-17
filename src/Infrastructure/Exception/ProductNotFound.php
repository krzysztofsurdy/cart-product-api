<?php
declare(strict_types=1);

namespace App\Infrastructure\Exception;

class ProductNotFound extends \Exception
{

    public function __construct(string $id)
    {
        parent::__construct("Product with ID $id was not found.");
    }
}
