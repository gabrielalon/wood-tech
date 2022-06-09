<?php declare(strict_types=1);

namespace Components\Accounts\ReadModel\Model;

final class AdminsPaginated
{
    /**
     * @param array<Admin> $admins
     */
    public function __construct(
        public readonly array $admins,
        public readonly int $total,
        public readonly int $perPage,
        public readonly int $currentPage,
        public readonly array $options = [],
    ) {
    }
}
