<?php

namespace Components\Accounts\Domain\Persist;

use Components\Accounts\Domain\Admin;

interface AdminRepository
{
    public function get(string $id): Admin;

    public function save(Admin $admin): void;
}
