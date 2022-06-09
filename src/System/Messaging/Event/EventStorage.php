<?php

namespace System\Messaging\Event;

use System\Messaging\Aggregate\AggregateChanged;
use System\Messaging\Aggregate\AggregateId;

final class EventStorage
{
    private ?AggregateChanged $tmpLastReleasedEvent;

    public function __construct(
        private readonly EventPublisher $eventPublisher,
        private readonly EventStreamRepository $streamRepository
    ) {
    }

    public function release(AggregateChanged $event): EventStorage
    {
        $this->eventPublisher->release($event);

        $this->tmpLastReleasedEvent = $event;

        return $this;
    }

    public function record(): void
    {
        if (null !== $this->tmpLastReleasedEvent) {
            $this->streamRepository->save($this->tmpLastReleasedEvent);
        }
    }

    public function load(AggregateId $aggregateId, int $lastVersion): \ArrayIterator
    {
        $iterator = new \ArrayIterator();

        foreach ($this->streamRepository->load($aggregateId, $lastVersion) as $event) {
            $iterator->append($event);
        }

        return $iterator;
    }
}
