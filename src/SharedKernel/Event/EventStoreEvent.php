<?php
declare(strict_types=1);

namespace App\SharedKernel\Event;

use Prooph\EventSourcing\AggregateChanged;

class EventStoreEvent extends AggregateChanged
{
    public function init(): void
    {
        if(!$this->createdAt) {
            $this->createdAt = new \DateTimeImmutable();
        }

        parent::init();
    }
}
