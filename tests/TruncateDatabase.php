<?php

declare(strict_types=1);

namespace Tests;

use Tests\Components\Accounts\Utils\Seeder\AdminSeeder;
use Tests\Components\Accounts\Utils\Seeder\UserSeeder;

trait TruncateDatabase
{
    public function truncateDatabase(): void
    {
        AdminSeeder::clear();
        UserSeeder::clear();
    }
}
