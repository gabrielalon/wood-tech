<?php

namespace Components\Accounts\ReadModel\Model;

use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;

final class User implements Authenticatable, Authorizable, CanResetPassword
{
    public function __construct(
        private string $id,
        private string $locale,
        private string $login,
        private string $password,
        private ?string $rememberToken,
        private array $roles,
        private array $permissions
    ) {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function locale(): string
    {
        return $this->locale;
    }

    public function login(): string
    {
        return $this->login;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function rememberToken(): ?string
    {
        return $this->rememberToken;
    }

    /**
     * @return string[]
     */
    public function roles(): array
    {
        return $this->roles;
    }

    /**
     * @return string[]
     */
    public function permissions(): array
    {
        return $this->permissions;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthIdentifierName(): string
    {
        return 'id';
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthIdentifier(): string
    {
        return $this->id();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthPassword(): string
    {
        return $this->password();
    }

    /**
     * {@inheritdoc}
     */
    public function getRememberToken(): string
    {
        return $this->rememberToken();
    }

    /**
     * {@inheritdoc}
     */
    public function setRememberToken($value): void
    {
        $this->rememberToken = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function getRememberTokenName(): string
    {
        return 'remember_token';
    }

    /**
     * {@inheritdoc}
     */
    public function can($ability, $arguments = [])
    {
        return in_array($ability, $this->permissions(), true);
    }

    /**
     * {@inheritdoc}
     */
    public function getEmailForPasswordReset()
    {
        return $this->login();
    }

    /**
     * {@inheritdoc}
     */
    public function sendPasswordResetNotification($token)
    {
    }

    public function hasAnyRole(array $roles = []): bool
    {
        foreach ($roles as $role) {
            if (true === $this->hasRole($role)) {
                return true;
            }
        }

        return false;
    }

    public function hasRole(string $role): bool
    {
        return in_array($role, $this->roles(), true);
    }
}
