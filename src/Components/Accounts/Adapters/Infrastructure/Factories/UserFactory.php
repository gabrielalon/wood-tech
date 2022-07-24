<?php declare(strict_types=1);

namespace Components\Accounts\Adapters\Infrastructure\Factories;

use Components\Accounts\Adapters\Infrastructure\ORM\User as UserEntity;
use Components\Accounts\Domain\User as DomainUser;
use Components\Accounts\Domain\ValueObjects as VO;
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

    public function makeDomainFromEntity(UserEntity $entity): DomainUser
    {
        return new DomainUser(
            new VO\UserId($entity->id),
            new VO\UserState($entity->state->type),
            new VO\UserLogin($entity->login),
            new VO\UserEmail($entity->email),
            new VO\UserPassword($entity->password),
            new VO\UserLocale($entity->locale),
            new VO\UserRememberToken($entity->remember_token),
            new VO\UserRoles($entity->roleTypes()),
        );
    }
}
