<?php

namespace Components\Accounts\Domain;

use Components\Accounts\Domain\ValueObjects as VO;

final class Admin
{
    public function __construct(
        public VO\AdminId $id,
        public VO\AdminUserId $userId,
        public VO\AdminFirstName $firstName,
        public VO\AdminLastName $lastName,
        public VO\AdminDeletedAt $deletedAt,
    ) {
    }

    public static function create(
        VO\AdminId $id,
        VO\AdminUserId $userId,
    ): Admin {
        return new self(
            $id,
            $userId,
            new VO\AdminFirstName(),
            new VO\AdminLastName(),
            new VO\AdminDeletedAt()
        );
    }

    public function changeName(VO\AdminFirstName $firstName, VO\AdminLastName $lastName): void
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public function remove(): void
    {
        $this->deletedAt = new VO\AdminDeletedAt(new \DateTimeImmutable());
    }
}
