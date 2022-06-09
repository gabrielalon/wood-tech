<?php

namespace System\Illuminate\Http\Middlewares;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

final class EncryptCookies extends Middleware
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];
}
