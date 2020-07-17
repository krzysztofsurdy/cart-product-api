<?php
declare(strict_types=1);

namespace App\Domain\Exception;

use App\Domain\ProductData;

class ProductDataFieldNotFound extends \Exception
{

    public function __construct(string $fieldName)
    {
        parent::__construct("Field $fieldName was not found in " . ProductData::class);
    }
}
