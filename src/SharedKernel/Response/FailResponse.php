<?php

declare(strict_types=1);

namespace App\SharedKernel\Response;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FailResponse extends JsonResponse
{
    public function __construct(string $message)
    {
        parent::__construct([
            'status' => 'FAILED',
            'message' => $message,
        ], Response::HTTP_BAD_REQUEST);
    }
}
