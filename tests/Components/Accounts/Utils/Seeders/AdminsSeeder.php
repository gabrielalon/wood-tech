<?php

declare(strict_types=1);

namespace Tests\Components\Accounts\Utils\Seeders;

use Components\Accounts\Adapters\Infrastructure\ORM\Admin;
use Database\Factories\AdminFactory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

final class AdminsSeeder
{
    public static function clear(): void
    {
        DB::table('admin')->delete();
        UsersSeeder::clear();
    }

    public static function seedOne(array $data = []): Admin
    {
        $id = Arr::get($data, 'id', '71983d5a-39c7-4002-9d31-ee12fe1adcd4');

        $user = UsersSeeder::seedOneWithAdminRole([
            'id' => Arr::get($data, 'user_id', '2cb7e695-7d21-4097-b91d-85ff0c60249f'),
            'email' => Arr::get($data, 'email', 'test@test.com'),
            'password' => Arr::get($data, 'password', 'P@ssw0rd'),
        ]);

        return AdminFactory::new()->create(['id' => $id, 'user_id' => $user->id]);
    }
}
