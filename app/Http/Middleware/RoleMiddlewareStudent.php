<?php

namespace App\Http\Middleware;

use Closure;
    use Illuminate\Support\Facades\Auth;

class RoleMiddlewareStudent
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role == 'studnt') {
            return $next($request);
        }

        return response()->view('errorPages.unauthorized', [], 403);

        // abort(403, 'Unauthorized!');
    }
}