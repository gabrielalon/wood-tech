<?php

namespace System\Illuminate\Http\Middlewares;

use Illuminate\Http\Middleware\TrustHosts as Middleware;

final class TrustHosts extends Middleware
{
    /**
     * Get the host patterns that should be trusted.
     *
     * @return array<int, string|null>
     */
    public function hosts()
    {
        return [
            $this->allSubdomainsOfApplicationUrl(),
        ];
    }
}
