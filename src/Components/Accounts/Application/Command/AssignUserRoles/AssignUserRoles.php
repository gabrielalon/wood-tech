<?php

namespace Components\Accounts\Application\Command\AssignUserRoles;

use System\Enum\RoleEnum;

final class AssignUserRoles
{
    /**
     * @param array<RoleEnum> $roles
     */
    public function __construct(
        private readonly string $id,
        private readonly array $roles,
    ) {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function roles(): array
    {
        return $this->roles;
    }
}
