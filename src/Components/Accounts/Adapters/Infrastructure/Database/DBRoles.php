<?php

namespace Components\Accounts\Adapters\Infrastructure\Database;

use Components\Accounts\Adapters\Infrastructure\Entity\Role as RoleEntity;
use Components\Accounts\Adapters\Infrastructure\Factory\RoleFactory;
use Components\Accounts\ReadModel\Model\Role;
use Components\Accounts\ReadModel\Ports\Roles;

final class DBRoles implements Roles
{
    public function __construct(
        private RoleEntity $db,
        private RoleFactory $factory,
    ) {
    }

    public function getRoles(): array
    {
        return $this->db->newQuery()
            ->with(['translations'])
            ->orderBy('level')
            ->get()
            ->map(fn (RoleEntity $entity): Role => $this->factory->fromEntity($entity))
            ->all();
    }
}
