<?php

namespace Components\Accounts\ReadModel\Model;

final class Admin
{
    public function __construct(
        private readonly string  $id,
        private readonly string  $locale,
        private readonly string  $userId,
        private readonly string  $login,
        private readonly string  $firstName,
        private readonly string  $lastName,
        private readonly ?string $email,
        private readonly array   $roles,
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

    public function userId(): string
    {
        return $this->userId;
    }

    public function login(): string
    {
        return $this->login;
    }

    public function firstName(): string
    {
        return $this->firstName;
    }

    public function lastName(): string
    {
        return $this->lastName;
    }

    public function email(): ?string
    {
        return $this->email;
    }

    public function fullName(): string
    {
        return sprintf('%s %s', $this->firstName(), $this->lastName());
    }

    public function roles(): array
    {
        return $this->roles;
    }
}
