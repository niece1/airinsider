<?php

namespace App\Http\Middleware;

use Closure;
use App\Traits\DashboardAccess;

class AuthGates
{
    use DashboardAccess;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = \Auth::user();

        if (!app()->runningInConsole() && $user) {
            $this->getDashboardAccess();        
        }
        return $next($request);
    }
}
