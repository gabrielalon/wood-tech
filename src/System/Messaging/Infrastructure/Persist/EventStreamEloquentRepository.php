<?php

namespace System\Messaging\Infrastructure\Persist;

use System\Illuminate\Auth;
use System\Messaging\Aggregate\AggregateChanged;
use System\Messaging\Aggregate\AggregateId;
use System\Messaging\Event\EventStreamRepository;
use System\Messaging\Infrastructure\Entity\EventStreamEntity;
use System\Messaging\Infrastructure\Service\JsonSerializer;
use Jenssegers\Agent\Agent;

final class EventStreamEloquentRepository implements EventStreamRepository
{
    public function __construct(
        private readonly Auth $auth,
        private readonly Agent $agent,
        private readonly JsonSerializer $serializer
    ) {
    }

    /**
     * {@inheritdoc}
     */
    public function save(AggregateChanged $event): void
    {
        EventStreamEntity::query()->create(array_merge($event->baseData(), [
            'payload' => $this->serializer->encode($event->payload()),
            'metadata' => $this->serializer->encode($this->extractMetadata()),
            'user_id' => $this->auth->user()?->id(),
        ]));
    }

    /**
     * @return array
     */
    private function extractMetadata(): array
    {
        $metadata = [];

        $metadata['device'] = $this->agent->device();
        $metadata['platform'] = $this->agent->platform();
        $metadata['platform_version'] = $this->agent->version((string) $metadata['platform']);
        $metadata['browser'] = $this->agent->browser();
        $metadata['browser_version'] = $this->agent->version((string) $metadata['browser']);
        $metadata['client_ip'] = $this->clientIP();
        $metadata['client_host'] = request()?->getHost();
        $metadata['environment'] = PHP_SAPI;

        return $metadata;
    }

    private function clientIP(): ?string
    {
        $keys = [
            'HTTP_CLIENT_IP',
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_FORWARDED',
            'HTTP_X_CLUSTER_CLIENT_IP',
            'HTTP_FORWARDED_FOR',
            'HTTP_FORWARDED',
            'REMOTE_ADDR',
        ];

        $flags = FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE;
        foreach ($keys as $key) {
            if (true === array_key_exists($key, $_SERVER)) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip); // just to be safe
                    if (false !== filter_var($ip, FILTER_VALIDATE_IP, $flags)) {
                        return $ip;
                    }
                }
            }
        }

        return request()?->ip();
    }

    public function load(AggregateId $aggregateId, int $lastVersion): array
    {
        return EventStreamEntity::query()
            ->where(['event_id' => $aggregateId->toString()])
            ->where('version', '>=', $lastVersion)
            ->get()
            ->map(function (EventStreamEntity $entity) {
                /** @var AggregateChanged $event */
                $event = $entity->event_name;
                $event = $event::occur($entity->event_id, $this->serializer->decode($entity->payload));

                return $event->withVersion($entity->version);
            })
            ->all();
    }
}
