<?php

namespace System\Messaging\Snapshot;

use System\Messaging\Aggregate\AggregateId;
use System\Messaging\Aggregate\AggregateRoot;

final class SnapshotStorage
{
    public function __construct(
        private readonly SnapshotRepository $repository
    ) {
    }

    public function make(AggregateRoot $aggregateRoot): void
    {
        $this->repository->save(new Snapshot($aggregateRoot, $aggregateRoot->version()));
    }

    public function get(string $aggregateType, AggregateId $aggregateId): Snapshot
    {
        return $this->repository->get($aggregateType, $aggregateId);
    }
}
