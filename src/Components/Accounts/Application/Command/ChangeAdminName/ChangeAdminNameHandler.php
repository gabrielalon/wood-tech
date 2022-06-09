<?php

namespace Components\Accounts\Application\Command\ChangeAdminName;

use Components\Accounts\Domain\Persist\AdminRepository;

final class ChangeAdminNameHandler
{
    public function __construct(
        private readonly AdminRepository $repository,
    ) {
    }

    public function __invoke(ChangeAdminName $command): void
    {
        $admin = $this->repository->get($command->id());

        [$firstName, $lastName] = explode(' ', $command->fullName());
        $admin->changeName($firstName, $lastName);

        $this->repository->save($admin);
    }
}
