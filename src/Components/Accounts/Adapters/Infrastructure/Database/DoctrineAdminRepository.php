<?php

namespace Components\Accounts\Adapters\Infrastructure\Database;

use Components\Accounts\Domain\Admin;
use Components\Accounts\Domain\Exception\AdminNotFound;
use Components\Accounts\Domain\Persist\AdminRepository;
use Doctrine\Persistence\ManagerRegistry;
use LaravelDoctrine\ORM\Facades\EntityManager;

final class DoctrineAdminRepository implements AdminRepository
{
    public function __construct(
        private readonly ManagerRegistry $doctrine
    ) {
    }

    public function get(string $id): Admin
    {
        if ($admin = $this->doctrine->getManager()->getRepository(Admin::class)->find($id)) {
            return $admin;
        }

        throw AdminNotFound::forId($id);
    }

    public function save(Admin $admin): void
    {
        $this->doctrine->getManager()->persist($admin);
        $this->doctrine->getManager()->flush();
    }
}
