<?php

namespace Components\Accounts\Application\Command\CreateAdmin;

use Components\Accounts\Domain\Admin;
use Components\Accounts\Domain\Ports\AdminsContract;
use Components\Accounts\Domain\Ports\UsersContract;
use Components\Accounts\Domain\User;
use Components\Accounts\Domain\ValueObjects AS VO;
use Illuminate\Contracts\Hashing\Hasher;
use System\Enum\RoleEnum;
use System\IdGenerator;

final class CreateAdminHandler
{
    public function __construct(
        private readonly Hasher $hasher,
        private readonly IdGenerator $idGenerator,
        private readonly UsersContract $userRepository,
        private readonly AdminsContract $adminRepository,
    ) {
    }

    public function __invoke(CreateAdmin $command): void
    {
        $userId = $this->idGenerator->uuid();
        $hashedPassword = $this->hasher->make($command->password());

        $user = User::create(new VO\UserId($userId), new VO\UserEmail($command->email()), new VO\UserPassword($hashedPassword));
        $user->assignRoles(new VO\UserRoles(RoleEnum::adminRoles()));

        $admin = Admin::create(new VO\AdminId($command->id()), new VO\AdminUserId($userId));
        $admin->changeName(new VO\AdminFirstName($command->firstName()), new VO\AdminLastName($command->lastName()));

        $this->userRepository->save($user);
        $this->adminRepository->save($admin);
    }
}
