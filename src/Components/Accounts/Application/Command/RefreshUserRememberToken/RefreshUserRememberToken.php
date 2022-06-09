<?php

namespace Components\Accounts\Application\Command\RefreshUserRememberToken;

final class RefreshUserRememberToken
{
    public function __construct(
        private readonly string $id,
        private readonly string $rememberToken
    ) {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function rememberToken(): string
    {
        return $this->rememberToken;
    }
}
