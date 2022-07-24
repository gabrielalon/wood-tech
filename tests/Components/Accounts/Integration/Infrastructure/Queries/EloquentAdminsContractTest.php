<?php

declare(strict_types=1);

namespace Tests\Components\Accounts\Integration\Infrastructure\Queries;

use Components\Accounts\Adapters\Infrastructure\Repositories\EloquentAdminsContract;
use Components\Accounts\Domain\Admin;
use Components\Accounts\Domain\Exception\AdminNotFound;
use Components\Accounts\Domain\ValueObjects\AdminId;
use Components\Accounts\Domain\ValueObjects\AdminUserId;
use Tests\Components\Accounts\Utils\Seeders\AdminsSeeder;
use Tests\Components\Accounts\Utils\Seeders\UsersSeeder;
use Tests\TestCase;

final class EloquentAdminsContractTest extends TestCase
{
    private EloquentAdminsContract $contract;

    protected function setUp(): void
    {
        parent::setUp();

        $this->contract = $this->app->get(EloquentAdminsContract::class);
    }

    /**
     * @test
     */
    public function shouldFailGettingAdminById(): void
    {
        $id = self::id();

        $this->expectExceptionObject(AdminNotFound::forId($id));

        $this->contract->find(new AdminId($id));
    }

    /**
     * @test
     */
    public function shouldGetAdminById(): void
    {
        AdminsSeeder::seedOne(['id' => $id = self::id()]);

        $admin = $this->contract->find($adminId = new AdminId($id));

        self::assertEquals($adminId->value(), $admin->id->value());
    }

    /**
     * @test
     */
    public function shouldSaveAdmin(): void
    {
        UsersSeeder::seedOneWithAdminRole(['id' => $userId = self::id()]);

        $this->contract->save(Admin::create(
            new AdminId($id = self::id()),
            new AdminUserId($userId),
        ));

        $this->assertDatabaseHas('admin', [
            'id' => $id,
            'user_id' => $userId,
        ]);
    }
}
