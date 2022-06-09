<?php

namespace System\Messaging\Aggregate;

final class AggregateTranslator
{
    public function __construct(
        protected readonly  AggregateRootDecorator $aggregateRootDecorator
    ) {
    }

    public function reconstituteAggregateFromType(string $aggregateType, AggregateId $aggregateId): AggregateRoot
    {
        return $this->aggregateRootDecorator->fromAggregateData($aggregateType, $aggregateId);
    }

    public function reconstituteAggregateFromHistory(string $aggregateType, \ArrayIterator $historyEvents): AggregateRoot
    {
        return $this->aggregateRootDecorator->fromHistory($aggregateType, $historyEvents);
    }

    public function extractPendingStreamEvents(AggregateRoot $aggregateRoot): array
    {
        return $this->aggregateRootDecorator->extractRecordedEvents($aggregateRoot);
    }
}
