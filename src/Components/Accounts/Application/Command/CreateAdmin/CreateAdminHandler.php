<?php

namespace Components\Accounts\Application\Command\CreateAdmin;

use Components\Accounts\Domain\Admin;
use Components\Accounts\Domain\Persist\AdminRepository;
use Components\Accounts\Domain\Persist\UserRepository;
use Components\Accounts\Domain\User;
use Illuminate\Contracts\Hashing\Hasher;
use Ramsey\Uuid\Uuid;
use System\Enum\RoleEnum;
use System\IdGenerator;

final class CreateAdminHandler
{
    public function __construct(
        private readonly Hasher $hasher,
        private readonly IdGenerator $idGenerator,
        private readonly UserRepository $userRepository,
        private readonly AdminRepository $adminRepository,
    ) {
    }

    public function __invoke(CreateAdmin $command): void
    {
        $this->userRepository->add($user = User::create(
            $userId = $this->idGenerator->uuid(),
            $command->email(),
            $this->hasher->make($command->password())
        ));

        $user->assignRoles([RoleEnum::ADMIN]);

        $this->userRepository->assignRoles($user);

        $this->adminRepository->save(Admin::create(
            Uuid::fromString($command->id()),
            $userId,
            $command->firstName(),
            $command->lastName(),
        ));
    }
}
