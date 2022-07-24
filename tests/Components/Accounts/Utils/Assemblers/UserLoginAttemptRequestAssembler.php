<?php

declare(strict_types=1);

namespace Tests\Components\Accounts\Utils\Assemblers;

final class UserLoginAttemptRequestAssembler
{
    public function __construct(
        private mixed $email,
        private mixed $password,
    ) {
    }

    public static function new(): self
    {
        return new self('test@test.com', 'P@ssw0rd');
    }

    public function withEmail(mixed $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function withPassword(mixed $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function assemble(): array
    {
        return array_filter([
            'email' => $this->email,
            'password' => $this->password,
        ]);
    }
}
