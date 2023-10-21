<?php

namespace App\Http\Middleware;

use App\Enumeration\Role;
use Closure;
use Illuminate\Support\Facades\Auth;


class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->role != Role::$ADMIN) {
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}
