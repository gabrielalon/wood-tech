<?php

declare(strict_types=1);

namespace Tests\Components\Accounts\Utils\Assembler;

use Components\Accounts\Application\Command\CreateAdmin\CreateAdmin;

final class CreateAdminAssembler
{
    public function __construct(
        private readonly string $id,
        private readonly string $email,
        private readonly string $password,
        private readonly string $firstName,
        private readonly string $lastName,
    ) {
    }

    public static function new(): self
    {
        return new self(
            '867d4ec5-f8a8-48e1-beb6-a287b7d11ca6',
            'test@test.com',
            'pass',
            'John',
            'Doe',
        );
    }

    public function assemble(): CreateAdmin
    {
        return new CreateAdmin(
            $this->id,
            $this->email,
            $this->password,
            $this->firstName,
            $this->lastName,
        );
    }
}
