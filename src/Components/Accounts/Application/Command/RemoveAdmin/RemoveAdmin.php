<?php

namespace Components\Accounts\Application\Command\RemoveAdmin;

final class RemoveAdmin
{
    public function __construct(
        private readonly string $id
    ) {
    }

    public function id(): string
    {
        return $this->id;
    }
}
