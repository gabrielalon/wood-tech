<?php

namespace System\Messaging\Event;

use System\Messaging\Aggregate\AggregateChanged;
use System\Messaging\Aggregate\AggregateId;

interface EventStreamRepository
{
    public function save(AggregateChanged $event): void;

    public function load(AggregateId $aggregateId, int $lastVersion): array;
}
