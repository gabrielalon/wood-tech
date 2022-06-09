<?php

namespace Components\Accounts\Application\Command\RefreshUserRememberToken;

use Components\Accounts\Domain\Persist\UserRepository;

final class RefreshUserRememberTokenHandler
{
    public function __construct(
        private readonly UserRepository $repository
    ) {
    }

    public function __invoke(RefreshUserRememberToken $command): void
    {
        $user = $this->repository->get($command->id());

        $user->refreshRememberToken($command->rememberToken());

        $this->repository->save($user);
    }
}
