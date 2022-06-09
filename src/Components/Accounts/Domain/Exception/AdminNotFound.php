<?php declare(strict_types=1);

namespace Components\Accounts\Domain\Exception;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class AdminNotFound extends NotFoundHttpException
{
    public static function forId(string $id): self
    {
        return new self("Admin not found for id: " . $id);
    }

    public static function forUserId(string $id): self
    {
        return new self("Admin not found for user id: " . $id);
    }
}
