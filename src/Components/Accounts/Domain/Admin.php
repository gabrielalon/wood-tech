<?php

namespace Components\Accounts\Domain;

use Ramsey\Uuid\UuidInterface;

final class Admin
{
    public function __construct(
        private UuidInterface $id,
        private UuidInterface $userId,
        private string $firstName,
        private string $lastName,
        private ?\DateTimeImmutable $deletedAt = null,
    ) {
    }

    public static function create(UuidInterface $id, UuidInterface $userId, string $firstName, string $lastName): Admin
    {
        return new self($id, $userId, $firstName, $lastName);
    }

    public function remove(): void
    {
        $this->deletedAt = new \DateTimeImmutable();
    }

    public function changeName(string $firstName, string $lastName): void
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }
}
