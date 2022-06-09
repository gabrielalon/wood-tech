<?php

namespace Components\Accounts\Application\Command\CreateUser;

use Components\Accounts\Domain\Persist\UserRepository;
use Components\Accounts\Domain\User;
use Illuminate\Contracts\Hashing\Hasher;

final class CreateUserHandler
{
    public function __construct(
        private readonly Hasher $hasher,
        private readonly UserRepository $repository
    ) {
    }

    public function __invoke(CreateUser $command): void
    {
        $this->repository->add(User::create(
            $command->id(),
            $command->login(),
            $this->hasher->make($command->password())
        ));
    }
}
