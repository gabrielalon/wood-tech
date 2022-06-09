<?php

declare(strict_types=1);

namespace Tests\Components\Accounts\Utils\Seeder;

use Components\Accounts\Adapters\Infrastructure\Entity\User;
use Database\Factories\UserFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use System\Enum\RoleEnum;

final class UserSeeder
{
    public static function clear(): void
    {
        DB::table('user_role')->delete();
        DB::table('user')->delete();
    }

    public static function seed(
        string $id = '64e5a4b4-1aa4-48f0-9dce-0ed5df6c028a',
        string $email = 'test@test.com',
        string $password = 'P@ssw0rd',
    ): User {
        $hash = Hash::make($password);

        $user = UserFactory::new()->createOne([
            'id' => $id,
            'email' => $email,
            'login' => $email,
            'password' => $hash,
        ]);
        $user->assignRoles([RoleEnum::ADMIN]);

        return $user;
    }
}
