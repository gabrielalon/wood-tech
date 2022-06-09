<?php

namespace Components\Accounts\ReadModel\Ports;

use Components\Accounts\ReadModel\Model\Role;

interface Roles
{
    /**
     * @return array<Role>
     */
    public function getRoles(): array;
}
