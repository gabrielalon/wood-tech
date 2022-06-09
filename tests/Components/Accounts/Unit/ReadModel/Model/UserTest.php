<?php

declare(strict_types=1);

namespace Tests\Components\Accounts\Unit\ReadModel\Model;

use Components\Accounts\ReadModel\Model\User;
use Illuminate\Support\Str;
use System\Enum\LocaleEnum;
use System\Enum\PermissionEnum;
use System\Enum\RoleEnum;
use Tests\UnitTestCase;

final class UserTest extends UnitTestCase
{
    /**
     * @test
     * @dataProvider userModelData
     */
    public function shouldCreate(
        string $id,
        string $locale,
        string $login,
        string $password,
        ?string $rememberToken,
        array $roles,
        array $permissions
    ): void {
        $model = new User(
            $id,
            $locale,
            $login,
            $password,
            $rememberToken,
            $roles,
            $permissions,
        );

        self::assertEquals($id, $model->id());
        self::assertEquals($locale, $model->locale());
        self::assertEquals($login, $model->login());
        self::assertEquals($password, $model->password());
        self::assertEquals($rememberToken, $model->rememberToken());
        self::assertEquals($roles, $model->roles());
        self::assertEquals($permissions, $model->permissions());
    }

    public function userModelData(): array
    {
        return [
            [
                self::id(),
                LocaleEnum::EN->value,
                'test@test.com',
                'pass',
                Str::random(60),
                [RoleEnum::ADMIN->value],
                [PermissionEnum::CREATE_ADMIN->value],
            ], [
                self::id(),
                LocaleEnum::PL->value,
                'test2@test.com',
                'pass2',
                null,
                [],
                [],
            ],
        ];
    }
}
