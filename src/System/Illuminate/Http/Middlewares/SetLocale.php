<?php

namespace System\Illuminate\Http\Middlewares;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

final class SetLocale
{
    /**
     * @param Request  $request
     * @param \Closure $next
     *
     * @return mixed
     *
     * @throws BindingResolutionException
     */
    public function handle(Request $request, \Closure $next)
    {
        $desiredLocale = $request->segment(1);
        $locale = locale()->isSupported($desiredLocale) ? $desiredLocale : locale()->fallback();

        locale()->set($locale);
        URL::defaults(['locale' => $locale]);

        return $next($request);
    }
}
