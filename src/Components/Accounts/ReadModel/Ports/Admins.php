<?php

namespace Components\Accounts\ReadModel\Ports;

use Components\Accounts\ReadModel\Model\Admin;
use Components\Accounts\ReadModel\Model\AdminsPaginated;

interface Admins
{
    public function existsAdminByEmail(string $email): bool;

    public function getAdminById(string $id): Admin;

    public function getAdminByUserId(string $userId): Admin;

    public function getAdminsPaginated(int $start, int $length = 10, array $options = []): AdminsPaginated;
}
