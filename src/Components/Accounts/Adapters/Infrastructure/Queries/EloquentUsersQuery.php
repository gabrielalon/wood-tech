<?php

namespace Components\Accounts\Adapters\Infrastructure\Queries;

use Components\Accounts\Adapters\Infrastructure\Factories\UserFactory;
use Components\Accounts\Adapters\Infrastructure\ORM\User as Entity;
use Components\Accounts\Domain\Exception\UserNotFound;
use Components\Accounts\ReadModel\Model\User;
use Components\Accounts\ReadModel\Ports\Users;
use System\Enum\RoleEnum;

final class EloquentUsersQuery implements Users
{
    public function __construct(
        private UserFactory $factory,
    ) {
    }

    public function getUserByLoginAndRole(string $login, RoleEnum $role): User
    {
        $entity = Entity::query()->selectRaw('user.*')
            ->join('user_role', 'user_role.user_id', '=', 'user.id')
            ->join('role', 'role.id', '=', 'user_role.role_id')
            ->where(['user.login' => $login, 'role.type' => $role->value])
            ->with(['roles', 'permissions'])
            ->first();

        if ($entity === null) {
            throw UserNotFound::forLogin($login);
        }

        return $this->factory->fromEntity($entity);
    }

    public function getUserById(string $id): User
    {
        if ($entity = Entity::findByUuid($id)) {
            return $this->factory->fromEntity($entity);
        }

        throw UserNotFound::forId($id);
    }

    public function getUserByIdAndRememberToken(string $id, string $token): User
    {
        $condition = ['id' => $id, 'remember_token' => $token];

        if ($entity = Entity::query()->where($condition)->first()) {
            assert($entity instanceof Entity);

            return $this->factory->fromEntity($entity);
        }

        throw UserNotFound::forId($id);
    }
}
