<?php

namespace System\Messaging\Snapshot;

use System\Messaging\Aggregate\AggregateId;

interface SnapshotRepository
{
    public function save(Snapshot $snapshot): void;

    public function get(string $aggregateType, AggregateId $aggregateId): Snapshot;
}
