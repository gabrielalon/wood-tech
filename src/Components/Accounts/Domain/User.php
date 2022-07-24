<?php

namespace Components\Accounts\Domain;

use Components\Accounts\Domain\ValueObjects as VO;
use System\Enum\LocaleEnum;
use System\Enum\StateEnum;

final class User
{
    public function __construct(
        public VO\UserId $id,
        public VO\UserState $state,
        public VO\UserLogin $login,
        public VO\UserEmail $email,
        public VO\UserPassword $password,
        public VO\UserLocale $locale,
        public VO\UserRememberToken $rememberToken,
        public VO\UserRoles $roles,
    ) {
    }

    public static function create(
        VO\UserId $id,
        VO\UserEmail $email,
        VO\UserPassword $password,
    ): User {
        return new self(
            $id,
            new VO\UserState(StateEnum::INACTIVE->value),
            new VO\UserLogin($email->value()),
            $email,
            $password,
            new VO\UserLocale(LocaleEnum::PL->value),
            new VO\UserRememberToken(),
            new VO\UserRoles(),
        );
    }

    public function assignRoles(VO\UserRoles $roles): void
    {
        $this->roles = $roles;
    }

    public function refreshLocale(VO\UserLocale $locale): void
    {
        $this->locale = $locale;
    }

    public function refreshRememberToken(VO\UserRememberToken $rememberToken): void
    {
        $this->rememberToken = $rememberToken;
    }

    public function changePassword(VO\UserPassword $password): void
    {
        $this->password = $password;
    }
}
