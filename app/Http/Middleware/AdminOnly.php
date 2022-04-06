<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
class AdminOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
            foreach (Auth::user()->getRoleNames() as $role) {
            
                if ($role=='admin' ) {
                    return $next($request);
                }else
                {
                    return redirect('no-permission');
                }
            }

        return redirect('');
    }
}
