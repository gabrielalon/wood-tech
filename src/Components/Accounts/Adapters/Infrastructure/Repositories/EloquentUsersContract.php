<?php declare(strict_types=1);

namespace Components\Accounts\Adapters\Infrastructure\Repositories;

use Components\Accounts\Adapters\Infrastructure\ORM\State;
use Components\Accounts\Adapters\Infrastructure\ORM\User as Entity;
use Components\Accounts\Domain\Exception\UserNotFound;
use Components\Accounts\Domain\Ports\UsersContract;
use Components\Accounts\Domain\User;
use Components\Accounts\Domain\ValueObjects as VO;

final class EloquentUsersContract implements UsersContract
{
    public function find(VO\UserId $userId): User
    {
        $entity = Entity::find($userId->value());

        if ($entity === null) {
            throw UserNotFound::forId($userId->value());
        }

        return new User(
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

    public function save(User $user): void
    {
        $state = State::getOrCreateByType($user->state->value());

        $entity = Entity::query()->updateOrCreate(['id' => $user->id->value()], [
            'state_id' => $state->id,
            'login' => $user->login->value(),
            'email' => $user->email->value(),
            'password' => $user->password->value(),
            'locale' => $user->locale->value(),
            'remember_token' => $user->rememberToken->value(),
        ]);

        assert($entity instanceof Entity);

        $entity->assignRoles($user->roles->values());
    }

    public function delete(User $user): void
    {
        Entity::query()->findOrFail($user->id->value())->delete();
    }
}
