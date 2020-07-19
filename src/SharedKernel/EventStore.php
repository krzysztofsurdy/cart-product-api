<?php

declare(strict_types=1);

namespace App\SharedKernel;

use Prooph\Common\Event\ActionEventEmitter;
use Prooph\EventStore\ActionEventEmitterEventStore;
use Prooph\EventStore\EventStore as ProophEventStore;
use Prooph\EventStoreBusBridge\EventPublisher;
use Prooph\ServiceBus\EventBus;
use Symfony\Component\Messenger\MessageBusInterface;

final class EventStore
{
    private ProophEventStore $proophEventStore;
    private ActionEventEmitter $actionEventEmitter;
    private EventBus $eventBus;
    private MessageBusInterface $merchantEventBus;

    public function __construct(
        ProophEventStore $proophEventStore,
        ActionEventEmitter $actionEventEmitter,
        EventBus $eventBus,
        MessageBusInterface $merchantEventBus
    ) {
        $this->proophEventStore = $proophEventStore;
        $this->actionEventEmitter = $actionEventEmitter;
        $this->eventBus = $eventBus;
        $this->merchantEventBus = $merchantEventBus;
    }

    public function createActionEventEmitterEventStore(): ActionEventEmitterEventStore
    {
        $actionEventEmitterEventStore = new ActionEventEmitterEventStore($this->proophEventStore, $this->actionEventEmitter);

        $eventPublisher = new EventPublisher($this->eventBus);
        $eventPublisher->attachToEventStore($actionEventEmitterEventStore);

        new EventHandler($this->eventBus, $this->merchantEventBus);

        return $actionEventEmitterEventStore;
    }
}
