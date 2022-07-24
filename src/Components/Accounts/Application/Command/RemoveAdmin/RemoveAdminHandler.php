<?php

namespace Components\Accounts\Application\Command\RemoveAdmin;

use Components\Accounts\Domain\Ports\AdminsContract;
use Components\Accounts\Domain\ValueObjects\AdminId;

final class RemoveAdminHandler
{
    public function __construct(
        private readonly AdminsContract $repository,
    ) {
    }

    public function __invoke(RemoveAdmin $command): void
    {
        $admin = $this->repository->find(new AdminId($command->id()));

        $admin->remove();

        $this->repository->save($admin);
    }
}
