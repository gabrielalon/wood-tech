<?php

namespace System\Messaging\Aggregate;

abstract class AggregateChanged
{
    public function __construct(
        protected string $aggregateId,
        protected array $payload,
        protected int $version = 1
    ) {
        $this->setAggregateId($aggregateId);
        $this->setVersion($version);
        $this->setPayload($payload);
    }

    public static function occur(string $aggregateId, array $payload = []): self
    {
        return new static($aggregateId, $payload);
    }

    public function aggregateId(): string
    {
        return $this->aggregateId;
    }

    public function payload(): array
    {
        return $this->payload;
    }

    public function version(): int
    {
        return $this->version;
    }

    public function eventName(): string
    {
        return __CLASS__;
    }

    public function baseData(): array
    {
        return [
            'event_id' => $this->aggregateId(),
            'event_name' => $this->eventName(),
            'version' => $this->version(),
        ];
    }

    abstract public function populate(AggregateRoot $aggregateRoot): void;

    protected function setVersion(int $version): void
    {
        $this->version = $version;
    }

    public function withVersion(int $version): self
    {
        $self = clone $this;
        $self->setVersion($version);

        return $self;
    }

    protected function setAggregateId(string $aggregateId): void
    {
        $this->aggregateId = $aggregateId;
    }

    protected function setPayload(array $payload): void
    {
        $this->payload = $payload;
    }
}
