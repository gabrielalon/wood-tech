<?php

namespace Components\Accounts\Adapters\Infrastructure\Database;

use Components\Accounts\Adapters\Infrastructure\Entity\Role;
use Components\Accounts\Adapters\Infrastructure\Entity\State;
use Components\Accounts\Adapters\Infrastructure\Entity\User as UserEntity;
use Components\Accounts\Domain\Exception\UserNotFound;
use Components\Accounts\Domain\Persist\UserRepository;
use Components\Accounts\Domain\User;
use System\Enum\LocaleEnum;
use System\Enum\RoleEnum;
use System\Enum\StateEnum;

final class DBUserRepository implements UserRepository
{
    public function __construct(
        private readonly UserEntity $db
    ) {
    }

    public function get(string $id): User
    {
        if ($entity = $this->db::findByUuid($id)) {
            return new User(
                $id,
                $entity->login,
                $entity->password,
                LocaleEnum::tryFrom($entity->locale),
                $entity->roles->map(fn (Role $role): RoleEnum => RoleEnum::tryFrom($role->type))->all(),
                $entity->remember_token,
            );
        }

        throw UserNotFound::forId($id);
    }

    public function add(User $user): void
    {
        $entity = new UserEntity();

        $entity->id = $user->id;
        $entity->state_id = State::getOrCreateByType(StateEnum::INACTIVE)->id;
        $entity->login = $user->login;
        $entity->locale = $user->locale->value;
        $entity->remember_token = $user->rememberToken;
        $entity->password = $user->password;
        $entity->save();
    }

    public function assignRoles(User $user): void
    {
        if ($entity = $this->db::findByUuid($user->id)) {
            $entity->assignRoles($user->roles);
        }
    }

    public function save(User $user): void
    {
        if ($entity = $this->db::findByUuid($user->id)) {
            $entity->locale = $user->locale->value;
            $entity->remember_token = $user->rememberToken;
            $entity->password = $user->password;
            $entity->save();
        }
    }
}
