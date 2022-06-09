<?php

declare(strict_types=1);

namespace Tests;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

trait IdGenerator
{
    protected static function id(): string
    {
        return Uuid::uuid4()->toString();
    }

    protected static function uuid(): UuidInterface
    {
        return Uuid::uuid4();
    }

    protected static function tryId(string $id): UuidInterface
    {
        return Uuid::fromString($id);
    }
}
