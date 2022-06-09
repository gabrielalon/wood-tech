<?php

declare(strict_types=1);

namespace Tests\Components\Accounts\Integration\Infrastructure\Database;

use Components\Accounts\Adapters\Infrastructure\Database\DoctrineAdminRepository;
use Components\Accounts\Domain\Admin;
use Tests\Components\Accounts\Utils\Seeder\AdminSeeder;
use Tests\Components\Accounts\Utils\Seeder\UserSeeder;
use Tests\TestCase;

final class DoctrineAdminRepositoryTest extends TestCase
{
    private DoctrineAdminRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = $this->app->get(DoctrineAdminRepository::class);
    }

    /**
     * @test
     * @doesNotPerformAssertions
     */
    public function shouldGetAdminById(): void
    {
        AdminSeeder::seed(id: $id = self::id());

        $this->repository->get($id);
    }

    /**
     * @test
     */
    public function shouldSaveAdmin(): void
    {
        UserSeeder::seed(id: $userId = self::id());

        $this->repository->save(Admin::create(
            $id = self::uuid(),
            self::tryId($userId),
            $firstName = 'John',
            $lastName = 'Doe',
        ));

        $this->assertDatabaseHas(
            'admin',
            [
                'id' => $id->toString(),
                'user_id' => $userId,
                'first_name' => $firstName,
                'last_name' => $lastName,
            ]
        );
    }
}
