<?php

namespace Components\Accounts\Application\Command\AssignUserRoles;

use Components\Accounts\Domain\Persist\UserRepository;

final class AssignUserRolesHandler
{
    public function __construct(
        private readonly UserRepository $repository,
    ) {
    }

    public function __invoke(AssignUserRoles $command): void
    {
        $user = $this->repository->get($command->id());

        $user->assignRoles($command->roles());

        $this->repository->assignRoles($user);
    }
}
