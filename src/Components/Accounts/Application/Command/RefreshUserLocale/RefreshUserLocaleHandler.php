<?php

namespace Components\Accounts\Application\Command\RefreshUserLocale;

use Components\Accounts\Domain\Persist\UserRepository;

final class RefreshUserLocaleHandler
{
    public function __construct(
        private readonly UserRepository $repository,
    ) {
    }

    public function __invoke(RefreshUserLocale $command): void
    {
        $user = $this->repository->get($command->id());

        $user->refreshLocale($command->locale());

        $this->repository->save($user);
    }
}
