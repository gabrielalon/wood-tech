<?php

namespace Components\Accounts\Application\Command\RemoveAdmin;

use Components\Accounts\Domain\Persist\AdminRepository;

final class RemoveAdminHandler
{
    public function __construct(
        private readonly AdminRepository $repository,
    ) {
    }

    public function __invoke(RemoveAdmin $command): void
    {
        $admin = $this->repository->get($command->id());

        $admin->remove();

        $this->repository->save($admin);
    }
}
