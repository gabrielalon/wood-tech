<?php

namespace Components\Accounts\Adapters\Infrastructure\Queries;

use Components\Accounts\Adapters\Infrastructure\Factories\RoleFactory;
use Components\Accounts\Adapters\Infrastructure\ORM\Role as Entity;
use Components\Accounts\ReadModel\Model\Role;
use Components\Accounts\ReadModel\Ports\Roles;

final class EloquentRolesQuery implements Roles
{
    public function __construct(
        private RoleFactory $factory,
    ) {
    }

    public function getRoles(): array
    {
        return Entity::query()
            ->with(['translations'])
            ->orderBy('level')
            ->get()
            ->map(fn (Entity $entity): Role => $this->factory->fromEntity($entity))
            ->all();
    }
}
