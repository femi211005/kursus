<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, $role = null)
    {
        $user = $request->user();
        Log::info('Middleware executed', ['user' => $user, 'role' => $role]);

        if (!$user) {
            Log::warning('User not authenticated');
            abort(403, 'Unauthorized');
        }
        
        if ($role && $user->role !== $role) {
            Log::warning('User does not have the correct role', ['expected' => $role, 'actual' => $user->role]);
            abort(403, 'Forbidden');
        }
        

        return $next($request);
    }
}
