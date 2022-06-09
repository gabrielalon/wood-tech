<?php

namespace System\Enum;

enum RoleEnum: string
{
    case ADMIN = 'admin';

    /**
     * @return string[]
     */
    public static function adminRoles(): array
    {
        return [self::ADMIN->value];
    }
}
