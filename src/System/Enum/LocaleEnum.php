<?php declare(strict_types=1);

namespace System\Enum;

enum LocaleEnum: string
{
    case EN = 'en';
    case PL = 'pl';

    public static function toString(string $separator): string
    {
        return implode($separator, array_map(
            static fn (LocaleEnum $enum): string => $enum->value,
            self::cases()
        ));
    }
}
