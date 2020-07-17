<?php

declare(strict_types=1);

namespace App\SharedKernel\Response;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class SuccessResponse extends JsonResponse
{
    public function __construct(array $data = null)
    {
        parent::__construct([
            'status' => 'OK',
            'data' => $data,
        ], Response::HTTP_OK);
    }
}
