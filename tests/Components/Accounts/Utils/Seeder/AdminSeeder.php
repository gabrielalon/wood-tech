<?php

declare(strict_types=1);

namespace Tests\Components\Accounts\Utils\Seeder;

use Components\Accounts\Adapters\Infrastructure\Entity\Admin;
use Database\Factories\AdminFactory;
use Illuminate\Support\Facades\DB;

final class AdminSeeder
{
    public static function clear(): void
    {
        DB::table('admin')->delete();
    }

    public static function seed(
        string $id = '1da67620-6216-45c3-bfa7-02bd040855a9',
        string $userId = 'e7659b21-1cb3-4926-8c13-ce0b28046c27',
        string $email = 'test@test.com',
        string $password = 'P@ssw0rd',
    ): Admin {
        $user = UserSeeder::seed($userId, $email, $password);

        return AdminFactory::new()->create(['id' => $id, 'user_id' => $user->id]);
    }
}
