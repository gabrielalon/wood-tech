<?php

namespace System\Illuminate\Rules;

use Illuminate\Contracts\Validation\Rule as BaseRule;

abstract class Rule implements BaseRule
{
    /**
     * @param string $key
     * @param string $default
     *
     * @return string
     */
    public function getLocalizedErrorMessage(string $key, string $default): string
    {
        return trans("validation.$key") === "validation.$key" ? $default : trans("validation.$key");
    }
}
