<?php declare(strict_types=1);

namespace Components\Accounts\Adapters\Infrastructure\Factory;

use Components\Accounts\Adapters\Infrastructure\Entity\User as UserEntity;
use Components\Accounts\ReadModel\Model\User;

final class UserFactory
{
    public function fromEntity(UserEntity $entity): User
    {
        return new User(
            $entity->id,
            $entity->locale,
            $entity->login,
            $entity->password,
            $entity->remember_token,
            $entity->roleTypes(),
            $entity->permissionTypes()
        );
    }
}
