<?php declare(strict_types=1);

namespace Components\Accounts\Domain\Exception;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class UserNotFound extends NotFoundHttpException
{
    public static function forId(string $id): self
    {
        return new self("User not found for id: " . $id);
    }

    public static function forLogin(string $login): self
    {
        return new self("User not found for login: " . $login);
    }
}
