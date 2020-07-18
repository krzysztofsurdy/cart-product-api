<?php

declare(strict_types=1);

namespace App\SharedKernel\Aggregate;

use App\SharedKernel\Exception\MethodNotExistingInAggregateException;
use Prooph\EventSourcing\AggregateChanged;
use ReflectionClass;

trait AggregateRootApply
{
    protected function apply(AggregateChanged $event): void
    {
        $object = new ReflectionClass($event);

        $methodName = sprintf('on%s', $object->getShortName());

        if (!method_exists($this, $methodName)) {
            throw new MethodNotExistingInAggregateException(self::class, $methodName);
        }

        $this->$methodName($event);
    }
}
