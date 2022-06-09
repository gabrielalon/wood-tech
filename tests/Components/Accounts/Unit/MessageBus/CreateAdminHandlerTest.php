<?php

declare(strict_types=1);

namespace Tests\Components\Accounts\Unit\MessageBus;

use Components\Accounts\Application\Command\CreateAdmin\CreateAdminHandler;
use Tests\Components\Accounts\Utils\Assembler\CreateAdminAssembler;
use Tests\MessageHandler;
use Tests\UnitTestCase;

final class CreateAdminHandlerTest extends UnitTestCase
{
    use MessageHandler;

    protected function handlerToTest(): string
    {
        return CreateAdminHandler::class;
    }

    /**
     * @test
     */
    public function shouldCallHandler(): void
    {
        $this->assertIsHandled(CreateAdminAssembler::new()->assemble());
    }
}
