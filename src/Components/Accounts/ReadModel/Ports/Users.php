<?php

namespace Components\Accounts\ReadModel\Ports;

use Components\Accounts\ReadModel\Model\User;
use System\Enum\RoleEnum;

interface Users
{
    public function getUserByLoginAndRole(string $login, RoleEnum $role): User;

    public function getUserById(string $id): User;

    public function getUserByIdAndRememberToken(string $id, string $token): User;
}
