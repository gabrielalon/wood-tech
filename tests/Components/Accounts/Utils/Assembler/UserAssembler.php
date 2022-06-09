<?php

declare(strict_types=1);

namespace Tests\Components\Accounts\Utils\Assembler;

use Components\Accounts\Adapters\Infrastructure\Entity\User as UserEntity;
use Components\Accounts\ReadModel\Model\User;
use System\Enum\LocaleEnum;

final class UserAssembler
{
    public function __construct(
        private string $id,
        private string $locale,
        private string $login,
        private string $password,
        private ?string $rememberToken = null,
        private array $roles = [],
        private array $permissions = [],
    ) {
    }

    public static function new(): self
    {
        return new self(
            '782863e6-71e2-44af-b52d-8b8391bff1ba',
            LocaleEnum::PL->value,
            'test@test.com',
            'password',
        );
    }

    public function fromEntity(UserEntity $entity): self
    {
        return new self(
            $entity->id,
            $entity->locale,
            $entity->login,
            $entity->password,
            $entity->remember_token,
            $entity->roleTypes(),
            $entity->permissionTypes()
        );
    }

    public function assemble(): User
    {
        return new User(
            $this->id,
            $this->locale,
            $this->login,
            $this->password,
            $this->rememberToken,
            $this->roles,
            $this->permissions
        );
    }
}
