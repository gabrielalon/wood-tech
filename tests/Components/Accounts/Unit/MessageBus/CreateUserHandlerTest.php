<?php

declare(strict_types=1);

namespace Tests\Components\Accounts\Unit\MessageBus;

use Components\Accounts\Application\Command\CreateUser\CreateUserHandler;
use Tests\Components\Accounts\Utils\Assemblers\CreateUserAssembler;
use Tests\MessageHandler;
use Tests\UnitTestCase;

final class CreateUserHandlerTest extends UnitTestCase
{
    use MessageHandler;

    protected function handlerToTest(): string
    {
        return CreateUserHandler::class;
    }

    /**
     * @test
     */
    public function shouldCallHandler(): void
    {
        $this->assertIsHandled(CreateUserAssembler::new()->assemble());
    }
}
