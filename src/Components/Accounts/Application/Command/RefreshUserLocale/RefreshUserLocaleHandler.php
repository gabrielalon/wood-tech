<?php

namespace Components\Accounts\Application\Command\RefreshUserLocale;

use Components\Accounts\Domain\Ports\UsersContract;
use Components\Accounts\Domain\ValueObjects as VO;

final class RefreshUserLocaleHandler
{
    public function __construct(
        private readonly UsersContract $repository,
    ) {
    }

    public function __invoke(RefreshUserLocale $command): void
    {
        $user = $this->repository->find(new VO\UserId($command->id()));

        $user->refreshLocale(new VO\UserLocale($command->locale()));

        $this->repository->save($user);
    }
}
