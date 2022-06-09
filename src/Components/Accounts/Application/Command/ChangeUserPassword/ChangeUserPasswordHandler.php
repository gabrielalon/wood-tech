<?php

namespace Components\Accounts\Application\Command\ChangeUserPassword;

use Components\Accounts\Domain\Persist\UserRepository;
use Illuminate\Contracts\Hashing\Hasher;

final class ChangeUserPasswordHandler
{
    public function __construct(
        private readonly Hasher $hasher,
        private readonly UserRepository $repository,
    ) {
    }

    public function __invoke(ChangeUserPassword $command): void
    {
        $user = $this->repository->get($command->id());

        $user->changePassword($this->hasher->make($command->password()));

        $this->repository->save($user);
    }
}
