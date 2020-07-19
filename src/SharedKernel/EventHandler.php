<?php

declare(strict_types=1);

namespace App\SharedKernel;

use App\SharedKernel\Event\ProductEvent;
use Prooph\EventSourcing\AggregateChanged;
use Prooph\ServiceBus\EventBus;
use Symfony\Component\Messenger\Exception\NoHandlerForMessageException;
use Symfony\Component\Messenger\MessageBusInterface;

final class EventHandler
{
    private MessageBusInterface $sharedEventBus;

    public function __construct(EventBus $eventBus, MessageBusInterface $sharedEventBus)
    {
        $this->sharedEventBus = $sharedEventBus;

        $router = new EventRouter();

        $router->route(ProductEvent::class)->to([$this, 'handle']);

        $router->attachToMessageBus($eventBus);
    }

    public function handle(AggregateChanged $aggregateChanged): void
    {
        try {
            $this->sharedEventBus->dispatch($aggregateChanged);
        } catch (NoHandlerForMessageException $exception) {
            // Do nothing
        } catch (\Exception $ex) {
            // Do nothing
        }
    }
}
