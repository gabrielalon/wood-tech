<?php

namespace Components\Accounts\Application\Command\CreateUser;

use Components\Accounts\Domain\Ports\UsersContract;
use Components\Accounts\Domain\User;
use Components\Accounts\Domain\ValueObjects AS VO;
use Illuminate\Contracts\Hashing\Hasher;

final class CreateUserHandler
{
    public function __construct(
        private readonly Hasher $hasher,
        private readonly UsersContract $repository
    ) {
    }

    public function __invoke(CreateUser $command): void
    {
        $userId = $command->id();
        $hashedPassword = $this->hasher->make($command->password());

        $user = User::create(new VO\UserId($userId), new VO\UserEmail($command->login()), new VO\UserPassword($hashedPassword));

        $this->repository->save($user);
    }
}
