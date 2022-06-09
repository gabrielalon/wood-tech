<?php

declare(strict_types=1);

namespace Tests\Components\Accounts\Integration\Application\Command;

use Tests\Components\Accounts\Utils\Assembler\RemoveAdminAssembler;
use Tests\Components\Accounts\Utils\Seeder\AdminSeeder;
use Tests\TestCase;

final class RemoveAdminHandlerTest extends TestCase
{
    /**
     * @test
     */
    public function shouldRemoveAdmin(): void
    {
        AdminSeeder::seed(id: $id = self::id());

        $command = RemoveAdminAssembler::new()->withId($id)->assemble();

        $this->getMessageBus()->dispatch($command);

        $this->assertSoftDeleted(
            'admin',
            [
                'id' => $id,
            ]
        );
    }
}
