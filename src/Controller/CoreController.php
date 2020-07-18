<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class CoreController extends AbstractController
{
    private const LABEL_SUCCESS = 'success';
    private const LABEL_DATA = 'data';

    protected function createApiResponse(bool $isSuccess, ?array $data, $statusCode = 200)
    {
        return new JsonResponse([
            self::LABEL_SUCCESS => $isSuccess,
            self::LABEL_DATA => $data
        ], $statusCode);
    }
}
