<?php

namespace System\Messaging\Aggregate;

use System\Messaging\Event\EventStorage;
use System\Messaging\Snapshot\SnapshotStorage;

abstract class AggregateRepository
{
    public function __construct(
        protected EventStorage $eventStorage,
        protected SnapshotStorage $snapshotStorage
    ) {
    }

    abstract public function getAggregateRootClass(): string;

    protected function saveAggregateRoot(AggregateRoot $aggregateRoot): void
    {
        foreach ($aggregateRoot->popRecordedEvents() as $aggregateChanged) {
            $this->eventStorage->release($aggregateChanged)->record();
        }

        $this->snapshotStorage->make($aggregateRoot);
    }

    protected function findAggregateRoot(AggregateId $aggregateId): AggregateRoot
    {
        $snapshot = $this->snapshotStorage->get($this->getAggregateRootClass(), $aggregateId);
        $events = $this->eventStorage->load($aggregateId, $snapshot->lastVersion() + 1);

        $aggregateRoot = $snapshot->aggregateRoot();
        $aggregateRoot->reconstituteFromSnapshot($snapshot);
        $aggregateRoot->replay($events);

        return $aggregateRoot;
    }
}
