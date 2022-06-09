<?php

namespace System\Messaging;

use Psr\Container\ContainerInterface;

final class MessageBus
{
    public function __construct(
        private readonly ContainerInterface $container
    ) {
    }

    public function dispatch(object $command): void
    {
        $handlerName = $command::class . 'Handler';

        $handler = $this->container->get($handlerName);
        $handler($command);
    }
}
