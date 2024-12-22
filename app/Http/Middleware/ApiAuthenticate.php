<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class ApiAuthenticate extends Middleware
{
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }
    }

    public function handle($request, Closure $next, ...$guards)
    {
        if ($request->bearerToken() == null) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        return parent::handle($request, $next, ...$guards);
    }
}