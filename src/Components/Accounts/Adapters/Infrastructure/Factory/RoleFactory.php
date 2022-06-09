<?php declare(strict_types=1);

namespace Components\Accounts\Adapters\Infrastructure\Factory;

use Components\Accounts\Adapters\Infrastructure\Entity\Role as RoleEntity;
use Components\Accounts\ReadModel\Model\Role;
use System\Enum\RoleEnum;
use System\Valuing\Intl\Language\Texts;

final class RoleFactory
{
    public function fromEntity(RoleEntity $entity): Role
    {
        return new Role(
            $entity->id,
            RoleEnum::tryFrom($entity->type),
            Texts::fromArray($entity->descriptions())
        );
    }
}
