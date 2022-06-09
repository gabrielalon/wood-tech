<?php

namespace Components\Accounts\Adapters\Infrastructure\Database;

use Components\Accounts\Adapters\Infrastructure\Entity\Admin as AdminEntity;
use Components\Accounts\Adapters\Infrastructure\Factory\AdminFactory;
use Components\Accounts\Domain\Exception\AdminNotFound;
use Components\Accounts\ReadModel\Model\Admin;
use Components\Accounts\ReadModel\Model\AdminsPaginated;
use Components\Accounts\ReadModel\Ports\Admins;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

final class DBAdmins implements Admins
{
    public function __construct(
        private AdminEntity $db,
        private AdminFactory $factory,
    ) {
    }

    public function existsAdminByEmail(string $email): bool
    {
        $condition = ['user.email' => $email];

        return $this->db->newQuery()
            ->join('user', 'user.id', '=', 'admin.user_id')
            ->where($condition)->exists();
    }

    public function getAdminById(string $id): Admin
    {
        if ($entity = AdminEntity::findByUuid($id)) {
            return $this->factory->fromEntity($entity);
        }

        throw AdminNotFound::forId($id);
    }

    public function getAdminByUserId(string $userId): Admin
    {
        $condition = ['user.id' => $userId];

        if ($entity = $this->db->newQuery()->selectRaw('admin.*')
            ->join('user', 'user.id', '=', 'admin.user_id')
            ->where($condition)->first()) {
            return $this->factory->fromEntity($entity);
        }

        throw AdminNotFound::forUserId($userId);
    }

    public function getAdminsPaginated(int $start, int $length = 10, array $options = []): AdminsPaginated
    {
        $query = $this->db->newQuery()->selectRaw('admin.*')
            ->join('user', 'user.id', '=', 'admin.user_id')
            ->orderBy('admin.created_at');

        $query->where(function (Builder $q) use ($options) {
            foreach (Arr::get($options, 'filter', []) as $field => $value) {
                if ('email' === $field) {
                    /* @phpstan-ignore-next-line */
                    $q->orWhereLike('user.email', $value);
                }
            }
        });

        $totalCount = $query->count();
        $admins = $query->with('user')->offset($start * $length)->limit($length)->get()
            ->map(fn (AdminEntity $entity): Admin => $this->factory->fromEntity($entity))
            ->all();

        return new AdminsPaginated($admins, $totalCount, $length, $start + 1, $options);
    }
}
