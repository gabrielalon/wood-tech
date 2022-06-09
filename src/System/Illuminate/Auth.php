<?php declare(strict_types=1);

namespace System\Illuminate;

use Components\Accounts\ReadModel\Model\Admin;
use Components\Accounts\ReadModel\Model\User;
use Components\Accounts\ReadModel\Ports\Admins;
use Components\Accounts\ReadModel\Ports\Users;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth as LaravelAuth;
use System\Enum\RoleEnum;

final class Auth
{
    private RoleEnum $role;

    public function __construct(
        private readonly Guard $auth,
        private readonly Users $users,
        private readonly Admins $admins
    ) {
        $this->role = RoleEnum::ADMIN;
    }

    public function withRole(RoleEnum $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function login(array $credentials = [], bool $remember = false): bool
    {
        Arr::set($credentials, 'role', $this->role);

        assert($this->auth instanceof StatefulGuard);

        return $this->auth->attempt($credentials, $remember);
    }

    public function loginAsUser(User $user): void
    {
        LaravelAuth::login($user);
    }

    public function logout(): void
    {
        LaravelAuth::logout();
    }

    public function check(): bool
    {
        return $this->auth->check();
    }

    public function user(): Authenticatable|User|null
    {
        return $this->auth->user();
    }

    public function admin(): Admin
    {
        return $this->admins->getAdminByUserId($this->user()->id());
    }

    public function reload(): User
    {
        $user = $this->user();

        $user = $this->users->getUserById($user->id());

        $this->loginAsUser($user);

        return $user;
    }
}
