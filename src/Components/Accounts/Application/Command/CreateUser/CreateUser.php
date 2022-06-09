<?php

namespace Components\Accounts\Application\Command\CreateUser;

final class CreateUser
{
    public function __construct(
        private readonly string $id,
        private readonly string $login,
        private readonly string $password
    ) {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function login(): string
    {
        return $this->login;
    }

    public function password(): string
    {
        return $this->password;
    }
}
