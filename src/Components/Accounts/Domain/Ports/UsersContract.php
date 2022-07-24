<?php

namespace Components\Accounts\Domain\Ports;

use Components\Accounts\Domain\User;
use Components\Accounts\Domain\ValueObjects\UserId;

interface UsersContract
{
    public function find(UserId $userId): User;

    public function save(User $user): void;

    public function delete(User $user): void;
}
