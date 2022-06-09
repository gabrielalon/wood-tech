<?php

declare(strict_types=1);

namespace Tests;

use DG\BypassFinals;
use Illuminate\Foundation\Testing\Concerns\InteractsWithContainer;
use Psr\Container\ContainerInterface;
use System\Messaging\MessageBus;

trait MessageHandler
{
    use InteractsWithContainer;

    private MessageBus $messageBus;

    abstract protected function handlerToTest(): string;

    private function setupHandlerSpy(string $handlerClass, object $command): void
    {
        BypassFinals::enable();

        $messageHandler = $this->createMock($handlerClass);
        $messageHandler->expects(self::once())->method('__invoke')->with($command);

        $container = $this->createMock(ContainerInterface::class);
        $container->expects(self::once())->method('get')->with($handlerClass)->willReturn($messageHandler);

        $this->messageBus = new MessageBus($container);
    }

    protected function assertIsHandled(object $command): void
    {
        $this->setupHandlerSpy($this->handlerToTest(), $command);

        $this->messageBus->dispatch($command);
    }
}
