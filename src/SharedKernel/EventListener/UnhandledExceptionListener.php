<?php

declare(strict_types=1);

namespace App\SharedKernel\EventListener;

use App\Controller\CoreController;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Messenger\Exception\HandlerFailedException;

final class UnhandledExceptionListener
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

        if ($exception) {
            $event->setResponse(CoreController::createFailApiResponse($exception));
        }
    }
}
