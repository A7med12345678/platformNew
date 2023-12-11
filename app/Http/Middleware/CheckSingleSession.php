<?php

namespace App\Http\Middleware;

use Closure;

class CheckSingleSession
{

    public function handle($request, Closure $next)
    {
        // Log::info('CheckSingleSession middleware is executing.');
        if (auth()->check()) {
            // Log::info(auth()->check());

            $user = auth()->user();
            $currentSessionId = session()->getId();

            if ($user->session_id !== $currentSessionId) {
                // Log::info($user->session_id !== $currentSessionId);

                auth()->logout();
                session()->invalidate();
                session()->regenerateToken();

                return redirect()->route('login')->withErrors(['error' => 'You are already logged in on another device.']);
            }

        }

        return $next($request);
    }

}
