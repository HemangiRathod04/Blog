<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,...$roles): Response
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized - User not authenticated'], 401);
        }
        $roleId = $user->role_id;
        if (!in_array($roleId, $roles)) {
            return response()->json(['error' => 'Unauthorized - Insufficient role'], 403);
        }
        return $next($request);
    }
}
