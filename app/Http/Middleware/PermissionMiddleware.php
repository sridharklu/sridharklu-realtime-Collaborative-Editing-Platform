<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class PermissionMiddleware
{
    public function handle(Request $request, Closure $next, $permission)
    {
        if (!auth()->user()->hasPermission($permission)) {
            return redirect('/');
        }
        return $next($request);
    }
}

