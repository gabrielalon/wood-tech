<?php declare(strict_types=1);

namespace Components\Contents\Domain\Enum;

enum PageTypeEnum: string
{
    case HOME = 'home';
    case PRIVACY_POLICY = 'privacy_policy';
}
