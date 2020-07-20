<?php
declare(strict_types=1);

namespace App\SharedKernel\Validator;

interface ValidatorInterface
{
    public static function validate(array $data): void;
}
