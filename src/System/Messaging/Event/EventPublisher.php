<?php

namespace System\Messaging\Event;

use System\Messaging\Aggregate\AggregateChanged;
use Psr\Container\ContainerInterface;

final class EventPublisher
{
    /** @var string[][] */
    private array $map;

    public function __construct(
        private readonly ContainerInterface $container
    ) {
        $this->map = [];
    }

    public function release(AggregateChanged $event): void
    {
        foreach ($this->map($event) as $projectorName) {
            $projector = $this->container->get($projectorName);

            $reflection = new \ReflectionMethod($projector, $this->methodName($event));
            $reflection->invoke($projector, $event);
        }
    }

    private function map(AggregateChanged $event): array
    {
        if (true === empty($this->map)) {
            $map = [];
            $pathPattern = base_path('src/Components/*/Resource/events/');

            $iterator = new \GlobIterator($pathPattern.'*.php');
            $iterator->rewind();
            while (true === $iterator->valid()) {
                /** @var string[][] $tmp */
                $tmp = include $iterator->current();
                $map = array_merge($map, $tmp);

                $iterator->next();
            }

            $this->map = $map;
        }

        return $this->map[$event->eventName()] ?? [];
    }

    private function methodName(AggregateChanged $event): string
    {
        $reflectionClass = new \ReflectionClass($event->eventName());

        return 'on'.$reflectionClass->getShortName();
    }
}
