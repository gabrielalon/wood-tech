<?php

namespace Components\Accounts\Adapters\Infrastructure\Database;

use Components\Accounts\Adapters\Infrastructure\Entity\User as UserEntity;
use Components\Accounts\Adapters\Infrastructure\Factory\UserFactory;
use Components\Accounts\Domain\Exception\UserNotFound;
use Components\Accounts\ReadModel\Model\User;
use Components\Accounts\ReadModel\Ports\Users;
use System\Enum\RoleEnum;

final class DBUsers implements Users
{
    public function __construct(
        private UserEntity $db,
        private UserFactory $factory,
    ) {
    }

    public function getUserByLoginAndRole(string $login, RoleEnum $role): User
    {
        $query = $this->db->newQuery()->selectRaw('user.*')
            ->join('user_role', 'user_role.user_id', '=', 'user.id')
            ->join('role', 'role.id', '=', 'user_role.role_id')
            ->where(['user.login' => $login, 'role.type' => $role->value])
            ->with(['roles', 'permissions'])
        ;

        if ($entity = $query->first()) {
            assert($entity instanceof UserEntity);

            return $this->factory->fromEntity($entity);
        }

        throw UserNotFound::forLogin($login);
    }

    public function getUserById(string $id): User
    {
        if ($entity = UserEntity::findByUuid($id)) {
            return $this->factory->fromEntity($entity);
        }

        throw UserNotFound::forId($id);
    }

    public function getUserByIdAndRememberToken(string $id, string $token): User
    {
        $condition = ['id' => $id, 'remember_token' => $token];

        if ($entity = $this->db->newQuery()->where($condition)->first()) {
            assert($entity instanceof UserEntity);

            return $this->factory->fromEntity($entity);
        }

        throw UserNotFound::forId($id);
    }
}
