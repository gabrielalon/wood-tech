<?php

namespace System\Messaging\Aggregate;

use Webmozart\Assert\Assert as Assertion;

final class AggregateRootDecorator extends AggregateRoot
{
    public static function newInstance(): self
    {
        return new static();
    }

    private function assertAggregateRootExistence(string $aggregateRootClass): void
    {
        Assertion::classExists($aggregateRootClass, 'Aggregate root class cannot be found. Got: %s');
    }

    public function fromAggregateData(string $aggregateType, AggregateId $aggregateId): AggregateRoot
    {
        $aggregateRoot = $this->fromHistory($aggregateType, new \ArrayIterator());
        $aggregateRoot->setAggregateId($aggregateId);

        return $aggregateRoot;
    }

    public function fromHistory(string $aggregateType, \ArrayIterator $aggregateChangedEvents): AggregateRoot
    {
        /* @var AggregateRoot $aggregateRootClass * */
        $aggregateRootClass = $aggregateType;
        $this->assertAggregateRootExistence($aggregateRootClass);

        return $aggregateRootClass::reconstituteFromHistory($aggregateChangedEvents);
    }

    public function extractRecordedEvents(AggregateRoot $aggregateRoot): array
    {
        return $aggregateRoot->popRecordedEvents();
    }
}
