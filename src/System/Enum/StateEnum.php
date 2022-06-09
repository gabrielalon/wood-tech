<?php

namespace System\Enum;

enum StateEnum: string
{
    case ACTIVE = 'active';
    case BLOCKED = 'blocked';
    case INACTIVE = 'inactive';
}
