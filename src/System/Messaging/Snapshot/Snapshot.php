<?php

namespace System\Messaging\Snapshot;

use System\Messaging\Aggregate\AggregateRoot;

final class Snapshot
{
    /** @var AggregateRoot */
    private $aggregateRoot;

    /** @var int */
    private $lastVersion;

    /**
     * Snapshot constructor.
     *
     * @param AggregateRoot $aggregateRoot
     * @param int           $lastVersion
     */
    public function __construct(AggregateRoot $aggregateRoot, int $lastVersion)
    {
        $this->aggregateRoot = $aggregateRoot;
        $this->lastVersion = $lastVersion;
    }

    /**
     * @return AggregateRoot
     */
    public function aggregateRoot(): AggregateRoot
    {
        return $this->aggregateRoot;
    }

    /**
     * @return string
     */
    public function aggregateType(): string
    {
        return $this->aggregateRoot->aggregateType();
    }

    /**
     * @return int
     */
    public function lastVersion(): int
    {
        return $this->lastVersion;
    }
}
