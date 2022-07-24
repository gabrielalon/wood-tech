<?php

declare(strict_types=1);

namespace Tests\Components\Accounts\Utils\Seeders;

use Components\Accounts\Adapters\Infrastructure\ORM\User;
use Database\Factories\UserFactory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use System\Enum\RoleEnum;

final class UsersSeeder
{
    public static function clear(): void
    {
        DB::table('user_role')->delete();
        DB::table('user')->delete();
    }

    public static function seedOneWithAdminRole(array $data = []): User
    {
        $hash = Hash::make(Arr::get($data, 'password', 'P@ssw0rd'));

        $user = UserFactory::new()->createOne([
            'id' => Arr::get($data, 'id', '6d04a760-3c79-411d-84f2-ab2a48a5c561'),
            'email' => Arr::get($data, 'email', 'test@test.com'),
            'login' => Arr::get($data, 'email', 'test@test.com'),
            'password' => $hash,
        ]);

        $user->assignRoles([RoleEnum::ADMIN]);

        return $user;
    }
}
