<?php

namespace System\Illuminate\Rules;

final class FullName extends Rule
{
    public function passes($attribute, $value): bool
    {
        return 1 === preg_match('/^[a-zA-Z]+(?:\s[a-zA-Z]+)+$/', $value);
    }

    public function message(): string
    {
        return $this->getLocalizedErrorMessage(
            'full_name',
            'Provided :attribute is invalid'
        );
    }
}
