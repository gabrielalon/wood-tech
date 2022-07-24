<?php

declare(strict_types=1);

namespace Tests\Components\Accounts\Utils\Assemblers;

use Components\Accounts\Application\Command\CreateUser\CreateUser;

final class CreateUserAssembler
{
    public function __construct(
        private readonly string $id,
        private readonly string $login,
        private readonly string $password,
    ) {
    }

    public static function new(): self
    {
        return new self(
            '867d4ec5-f8a8-48e1-beb6-a287b7d11ca6',
            'test@test.com',
            'pass',
        );
    }

    public function assemble(): CreateUser
    {
        return new CreateUser(
            $this->id,
            $this->login,
            $this->password,
        );
    }
}
