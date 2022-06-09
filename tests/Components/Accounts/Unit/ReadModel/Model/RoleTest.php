<?php

declare(strict_types=1);

namespace Tests\Components\Accounts\Unit\ReadModel\Model;

use Components\Accounts\ReadModel\Model\Role;
use System\Enum\RoleEnum;
use System\Valuing\Intl\Language\Texts;
use Tests\UnitTestCase;

final class RoleTest extends UnitTestCase
{
    /**
     * @test
     */
    public function shouldCreate(): void
    {
        $model = new Role(
            $id = self::id(),
            $role = RoleEnum::ADMIN,
            $texts = Texts::fromArray([$locale = 'pl' => $this->faker->words(asText: true)]),
        );

        self::assertEquals($id, $model->id());
        self::assertEquals($role->value, $model->type());
        self::assertEquals($texts->locale($locale)->toString(), $model->description($locale));
    }
}
