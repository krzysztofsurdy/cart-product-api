<?php

declare(strict_types=1);

namespace App\SharedKernel;

use Prooph\Common\Event\ActionEvent;
use Prooph\ServiceBus\EventBus;

class EventRouter extends \Prooph\ServiceBus\Plugin\Router\EventRouter
{
    public function onRouteMessage(ActionEvent $actionEvent): void
    {
        $listeners = $actionEvent->getParam(EventBus::EVENT_PARAM_EVENT_LISTENERS, []);

        $listeners = array_merge($listeners, reset($this->eventMap));

        $actionEvent->setParam(EventBus::EVENT_PARAM_EVENT_LISTENERS, $listeners);

        parent::onRouteMessage($actionEvent);
    }
}
