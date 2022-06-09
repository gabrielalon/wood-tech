<?php

namespace Components\Accounts\Adapters\Infrastructure\Service;

use Components\Accounts\Application\Account;
use Components\Accounts\Application\Service\AuthProvider;
use Components\Accounts\Domain\Exception\UserNotFound;
use Components\Accounts\ReadModel\Model\User;
use Components\Accounts\ReadModel\Ports\Users;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Support\Arr;
use System\Enum\RoleEnum;

final class UserAuthProvider implements AuthProvider
{
    public function __construct(
        private readonly Users $users,
        private readonly Hasher $hasher,
        private readonly Account $account,
    ) {
    }

    /**
     * {@inheritdoc}
     */
    public function retrieveById($identifier): ?User
    {
        return $this->users->getUserById($identifier);
    }

    /**
     * {@inheritdoc}
     */
    public function retrieveByToken($identifier, $token): ?User
    {
        return $this->users->getUserByIdAndRememberToken($identifier, $token);
    }

    /**
     * {@inheritdoc}
     */
    public function updateRememberToken(Authenticatable $user, $token): void
    {
        dd($token);
        $this->account->refreshUserRememberToken($user->getAuthIdentifier(), $token);
    }

    /**
     * {@inheritdoc}
     */
    public function retrieveByCredentials(array $credentials): ?User
    {
        if ($login = Arr::get($credentials, 'email', false)) {
            $role = Arr::get($credentials, 'role', RoleEnum::ADMIN);

            return $this->retrieveByLoginAndRole($login, $role);
        }

        return null;
    }

    private function retrieveByLoginAndRole(string $login, RoleEnum $role): ?User
    {
        try {
            return $this->users->getUserByLoginAndRole($login, $role);
        } catch (UserNotFound $exception) {
            return null;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function validateCredentials(Authenticatable $user, array $credentials): bool
    {
        if (true === Arr::exists($credentials, 'password')) {
            $plain = $credentials['password'];

            return $this->hasher->check($plain, $user->getAuthPassword());
        }

        return false;
    }
}
