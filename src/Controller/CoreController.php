<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class CoreController extends AbstractController
{
    private const LABEL_SUCCESS = 'success';
    private const LABEL_DATA = 'data';
    private const LABEL_MESSAGE = 'message';
    private const LABEL_FILE = 'file';
    private const LABEL_LINE = 'line';

    public static function createSuccessApiResponse(?array $data, int $statusCode = 200): Response
    {
        return new JsonResponse([
            self::LABEL_SUCCESS => true,
            self::LABEL_DATA    => $data
        ], $statusCode);
    }

    public static function createFailApiResponse(Throwable $exception, int $statusCode = 400): Response
    {
        return new JsonResponse([
            self::LABEL_SUCCESS => false,
            self::LABEL_MESSAGE => $exception->getMessage(),
            self::LABEL_FILE    => $exception->getFile(),
            self::LABEL_LINE    => $exception->getLine()
        ], $statusCode);
    }
}
