<?php

namespace Components\Accounts\Application;

use Components\Accounts\Application\Command;
use Illuminate\Support\Str;
use System\IdGenerator;
use System\Messaging\MessageBus;

final class Account
{
    public function __construct(
        private readonly MessageBus $messageBus,
        private readonly IdGenerator $idGenerator,
    ) {
    }

    public function changeUserPassword(string $userId, string $password): void
    {
        $this->messageBus->dispatch(new Command\ChangeUserPassword\ChangeUserPassword($userId, $password));
        $this->refreshUserRememberToken($userId, Str::random(60));
    }

    public function createAdmin(string $firstName, string $lastName, string $email, string $password): void
    {
        $this->messageBus->dispatch(new Command\CreateAdmin\CreateAdmin(
            $this->idGenerator->id(),
            $email,
            $password,
            $firstName,
            $lastName,
        ));
    }

    public function updateAdmin(string $adminId, string $fullName, string $email, string $locale): void
    {
        $this->messageBus->dispatch(new Command\ChangeAdminName\ChangeAdminName($adminId, $fullName));
    }

    public function removeAdmin(string $adminId): void
    {
        $this->messageBus->dispatch(new Command\RemoveAdmin\RemoveAdmin($adminId));
    }

    public function refreshUserRememberToken(string $userId, string $token): void
    {
        $this->messageBus->dispatch(new Command\RefreshUserRememberToken\RefreshUserRememberToken($userId, $token));
    }
}
