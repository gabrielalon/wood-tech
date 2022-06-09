<?php

declare(strict_types=1);

namespace Tests\Components\Accounts\Integration\Infrastructure\Database;

use Components\Accounts\Adapters\Infrastructure\Database\DBAdmins;
use Components\Accounts\Domain\Exception\AdminNotFound;
use Tests\Components\Accounts\Utils\Seeder\AdminSeeder;
use Tests\TestCase;

final class DBAdminsTest extends TestCase
{
    private DBAdmins $admins;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admins = $this->app->get(DBAdmins::class);
    }

    /**
     * @test
     */
    public function shouldAdminExistsByEmail(): void
    {
        AdminSeeder::seed(email: $email = 'john@doe.com');

        self::assertTrue($this->admins->existsAdminByEmail($email));
    }

    /**
     * @test
     */
    public function shouldAdminNotExistsByEmail(): void
    {
        self::assertFalse($this->admins->existsAdminByEmail('some@email.com'));
    }

    /**
     * @test
     */
    public function shouldGetAdminById(): void
    {
        AdminSeeder::seed(id: $id = self::id());

        $admin = $this->admins->getAdminById($id);

        self::assertEquals($id, $admin->id());
    }

    /**
     * @test
     */
    public function shouldFailGettingAdminById(): void
    {
        $this->expectException(AdminNotFound::class);

        $this->admins->getAdminById(self::id());
    }

    /**
     * @test
     */
    public function shouldGetAdminByUserId(): void
    {
        AdminSeeder::seed(userId: $id = self::id());

        $admin = $this->admins->getAdminByUserId($id);

        self::assertEquals($id, $admin->userId());
    }

    /**
     * @test
     */
    public function shouldFailGettingAdminByUserId(): void
    {
        $this->expectException(AdminNotFound::class);

        $this->admins->getAdminByUserId(self::id());
    }

    /**
     * @test
     */
    public function shouldGetAdminsPaginated(): void
    {
        AdminSeeder::seed(id: $id = self::id());

        $paginated = $this->admins->getAdminsPaginated(0, $perPage = 5);

        self::assertNotEmpty($paginated->admins);
        self::assertEquals($id, $paginated->admins[0]->id());
        self::assertEquals(1, $paginated->total);
        self::assertEquals(1, $paginated->currentPage);
        self::assertEquals($perPage, $paginated->perPage);
    }
}
