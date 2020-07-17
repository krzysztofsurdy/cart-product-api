<?php

declare(strict_types=1);

namespace App\SharedKernel\EventListener;

use App\SharedKernel\Response\FailResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Messenger\Exception\HandlerFailedException;

class UnhandledExceptionListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        if ($exception instanceof HttpException || 0 !== $exception->getCode()) {
            return;
        }
        if ($exception instanceof HandlerFailedException && $exception->getPrevious()) {
            $exception = $exception->getPrevious();
        }

        $event->setResponse(new FailResponse($exception->getMessage()));
    }
}
