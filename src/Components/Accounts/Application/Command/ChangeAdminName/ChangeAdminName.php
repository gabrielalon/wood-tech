<?php

namespace Components\Accounts\Application\Command\ChangeAdminName;

final class ChangeAdminName
{
    public function __construct(
        private readonly string $id,
        private readonly string $fullName,
    ) {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function fullName(): string
    {
        return $this->fullName;
    }
}
