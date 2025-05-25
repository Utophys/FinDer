<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user || $user->ROLE !== 'admin') {
            abort(403, 'Unauthorized - Admins only');
        }

        return $next($request);
    }

}
