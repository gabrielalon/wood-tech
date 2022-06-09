<?php

namespace Components\Accounts\Domain\Persist;

use Components\Accounts\Domain\User;

interface UserRepository
{
    public function get(string $id): User;

    public function add(User $user): void;

    public function assignRoles(User $user): void;

    public function save(User $user): void;
}
