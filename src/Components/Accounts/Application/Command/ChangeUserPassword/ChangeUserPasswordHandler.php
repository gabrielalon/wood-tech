<?php

namespace Components\Accounts\Application\Command\ChangeUserPassword;

use Components\Accounts\Domain\Ports\UsersContract;
use Components\Accounts\Domain\ValueObjects as VO;
use Illuminate\Contracts\Hashing\Hasher;

final class ChangeUserPasswordHandler
{
    public function __construct(
        private readonly Hasher $hasher,
        private readonly UsersContract $repository,
    ) {
    }

    public function __invoke(ChangeUserPassword $command): void
    {
        $user = $this->repository->find(new VO\UserId($command->id()));

        $user->changePassword(new VO\UserPassword($this->hasher->make($command->password())));

        $this->repository->save($user);
    }
}
