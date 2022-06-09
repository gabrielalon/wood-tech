<?php

namespace System\Messaging\Infrastructure\Persist;

use System\Messaging\Aggregate\AggregateId;
use System\Messaging\Aggregate\AggregateRoot;
use System\Messaging\Aggregate\AggregateRootDecorator;
use System\Messaging\Aggregate\AggregateTranslator;
use System\Messaging\Infrastructure\Entity\SnapshotEntity;
use System\Messaging\Infrastructure\Service\CallbackSerializer;
use System\Messaging\Snapshot\Snapshot;
use System\Messaging\Snapshot\SnapshotRepository;

final class SnapshotEloquentRepository implements SnapshotRepository
{
    private AggregateTranslator $aggregateTranslator;

    public function __construct(
        private readonly SnapshotEntity $db,
        private readonly CallbackSerializer $serializer
    ) {
        $this->aggregateTranslator = new AggregateTranslator(AggregateRootDecorator::newInstance());
    }

    public function save(Snapshot $snapshot): void
    {
        $this->db->newQuery()->updateOrCreate($this->extractCreateData($snapshot), [
            'last_version' => $snapshot->lastVersion(),
            'aggregate' => $this->serializer->serialize($snapshot->aggregateRoot()),
        ]);
    }

    private function extractCreateData(Snapshot $snapshot): array
    {
        return [
            'aggregate_id' => $snapshot->aggregateRoot()->aggregateId(),
            'aggregate_type' => $snapshot->aggregateType(),
        ];
    }

    public function get(string $aggregateType, AggregateId $aggregateId): Snapshot
    {
        $condition = ['aggregate_id' => $aggregateId->toString(), 'aggregate_type' => $aggregateType];

        try {
            $entity = $this->db->newQuery()->where($condition)->firstOrFail();
            assert($entity instanceof SnapshotEntity);

            $aggregateRoot = $this->serializer->unserialize($entity->aggregate);
            assert($aggregateRoot instanceof AggregateRoot);

            return new Snapshot($aggregateRoot, $entity->last_version);
        } catch (\Exception $e) {
            $aggregateRoot = $this->aggregateTranslator->reconstituteAggregateFromType($aggregateType, $aggregateId);

            return new Snapshot($aggregateRoot, 0);
        }
    }
}
