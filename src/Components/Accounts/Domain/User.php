<?php

namespace Components\Accounts\Domain;

use System\Enum\LocaleEnum;
use System\Enum\RoleEnum;

final class User
{
    /**
     * @param array<RoleEnum> $roles
     */
    public function __construct(
        public string $id,
        public string $login,
        public string $password,
        public LocaleEnum $locale,
        public array $roles = [],
        public string|null $rememberToken = null,
    ) {
    }

    public static function create(string $id, string $login, string $password): User
    {
        return new self($id, $login, $password, LocaleEnum::PL);
    }

    public function refreshLocale(LocaleEnum $locale): void
    {
        $this->locale = $locale;
    }

    public function refreshRememberToken(string $rememberToken): void
    {
        $this->rememberToken = $rememberToken;
    }

    /**
     * @param array<RoleEnum> $roles
     */
    public function assignRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    public function changePassword(string $password): void
    {
        $this->password = $password;
    }
}
