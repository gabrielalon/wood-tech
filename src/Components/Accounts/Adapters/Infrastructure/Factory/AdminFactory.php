<?php declare(strict_types=1);

namespace Components\Accounts\Adapters\Infrastructure\Factory;

use Components\Accounts\Adapters\Infrastructure\Entity\Admin as AdminEntity;
use Components\Accounts\Adapters\Infrastructure\Entity\Role;
use Components\Accounts\ReadModel\Model\Admin;

final class AdminFactory
{
    public function fromEntity(AdminEntity $entity): Admin
    {
        return new Admin(
            $entity->id,
            $entity->user->locale,
            $entity->user->id,
            $entity->user->login,
            $entity->first_name,
            $entity->last_name,
            $entity->user->email,
            $entity->user->roles->map(fn (Role $role): string => $role->type)->all(),
        );
    }
}
