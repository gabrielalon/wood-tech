<?php

declare(strict_types=1);

namespace Tests;

use Tests\Components\Accounts\Utils\Seeders\AdminsSeeder;
use Tests\Components\Accounts\Utils\Seeders\UsersSeeder;

trait TruncateDatabase
{
    public function truncateDatabase(): void
    {
        AdminsSeeder::clear();
        UsersSeeder::clear();
    }
}
