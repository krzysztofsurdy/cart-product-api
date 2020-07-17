<?php

declare(strict_types=1);

namespace App\SharedKernel\Exception;

use Symfony\Component\HttpFoundation\JsonResponse;

abstract class ApiException extends \Exception
{
    /** @var string */
    protected $message;
    protected array $container = [];

    public function __construct(string $message)
    {
        $this->message = $message;
        parent::__construct($message, JsonResponse::HTTP_BAD_REQUEST);
    }

    public function getContainer(): array
    {
        return $this->container;
    }

    public function toArray(): array
    {
        $reflection = new \ReflectionClass($this);

        return [
            'status' => 'FAILED',
            'message' => $this->message,
            'code' => $reflection->getShortName(),
        ];
    }
}
