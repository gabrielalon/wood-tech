<?php

namespace Components\Accounts\Application\Command\AssignUserRoles;

use Components\Accounts\Domain\Ports\UsersContract;
use Components\Accounts\Domain\ValueObjects\UserId;
use Components\Accounts\Domain\ValueObjects\UserRoles;

final class AssignUserRolesHandler
{
    public function __construct(
        private readonly UsersContract $repository,
    ) {
    }

    public function __invoke(AssignUserRoles $command): void
    {
        $userId = new UserId($command->id());
        $user = $this->repository->find($userId);

        $user->assignRoles(new UserRoles($command->roles()));

        $this->repository->save($user);
    }
}
