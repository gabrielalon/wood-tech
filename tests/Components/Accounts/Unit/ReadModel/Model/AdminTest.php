<?php

declare(strict_types=1);

namespace Tests\Components\Accounts\Unit\ReadModel\Model;

use Components\Accounts\ReadModel\Model\Admin;
use System\Enum\LocaleEnum;
use System\Enum\RoleEnum;
use Tests\UnitTestCase;

final class AdminTest extends UnitTestCase
{
    /**
     * @test
     */
    public function shouldCreate(): void
    {
        $model = new Admin(
            $id = self::id(),
            $locale = LocaleEnum::EN->value,
            $userId = self::id(),
            $login = $this->faker->email(),
            $firstName = $this->faker->firstName(),
            $lastName = $this->faker->lastName(),
            $email = $login,
            $roles = [
                RoleEnum::ADMIN->value,
            ],
        );

        self::assertEquals($id, $model->id());
        self::assertEquals($locale, $model->locale());
        self::assertEquals($userId, $model->userId());
        self::assertEquals($login, $model->login());
        self::assertEquals($firstName, $model->firstName());
        self::assertEquals($lastName, $model->lastName());
        self::assertEquals($email, $model->email());
        self::assertEquals($roles, $model->roles());
    }
}
