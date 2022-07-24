<?php

namespace Components\Accounts\Application\Command\RefreshUserRememberToken;

use Components\Accounts\Domain\Ports\UsersContract;
use Components\Accounts\Domain\ValueObjects as VO;

final class RefreshUserRememberTokenHandler
{
    public function __construct(
        private readonly UsersContract $repository
    ) {
    }

    public function __invoke(RefreshUserRememberToken $command): void
    {
        $user = $this->repository->find(new VO\UserId($command->id()));

        $user->refreshRememberToken(new VO\UserRememberToken($command->rememberToken()));

        $this->repository->save($user);
    }
}
