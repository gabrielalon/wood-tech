<?php

namespace Components\Accounts\Domain\Ports;

use Components\Accounts\Domain\Admin;
use Components\Accounts\Domain\ValueObjects\AdminId;

interface AdminsContract
{
    public function find(AdminId $adminId): Admin;

    public function save(Admin $admin): void;

    public function delete(Admin $admin): void;
}
