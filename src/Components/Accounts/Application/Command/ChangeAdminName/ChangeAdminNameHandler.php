<?php

namespace Components\Accounts\Application\Command\ChangeAdminName;

use Components\Accounts\Domain\Ports\AdminsContract;
use Components\Accounts\Domain\ValueObjects as VO;

final class ChangeAdminNameHandler
{
    public function __construct(
        private readonly AdminsContract $repository,
    ) {
    }

    public function __invoke(ChangeAdminName $command): void
    {
        $admin = $this->repository->find(new VO\AdminId($command->id()));

        [$firstName, $lastName] = explode(' ', $command->fullName());
        $admin->changeName(new VO\AdminFirstName($firstName), new VO\AdminLastName($lastName));

        $this->repository->save($admin);
    }
}
