<?php declare(strict_types=1);

namespace Components\Accounts\Adapters\Infrastructure\Repositories;

use Components\Accounts\Adapters\Infrastructure\ORM\Admin as Entity;
use Components\Accounts\Domain\Admin;
use Components\Accounts\Domain\Exception\AdminNotFound;
use Components\Accounts\Domain\Ports\AdminsContract;
use Components\Accounts\Domain\ValueObjects as VO;

final class EloquentAdminsContract implements AdminsContract
{
    public function find(VO\AdminId $adminId): Admin
    {
        $entity = Entity::query()->find($adminId->value());

        if ($entity === null) {
            throw AdminNotFound::forId($adminId->value());
        }

        return new Admin(
            new VO\AdminId($entity->id),
            new VO\AdminUserId($entity->user_id),
            new VO\AdminFirstName($entity->first_name),
            new VO\AdminLastName($entity->last_name),
            new VO\AdminDeletedAt($entity->deleted_at),
        );
    }

    public function save(Admin $admin): void
    {
        Entity::query()->updateOrCreate(['id' => $admin->id->value()], [
            'user_id' => $admin->userId->value(),
            'first_name' => $admin->firstName->value(),
            'last_name' => $admin->lastName->value(),
            'deleted_at' => $admin->deletedAt?->value(),
        ]);
    }

    public function delete(Admin $admin): void
    {
        Entity::query()->findOrFail($admin->id->value())->delete();
    }
}
