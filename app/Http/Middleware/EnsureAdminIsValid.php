<?php

namespace App\Http\Middleware;

use App\UserRole;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureAdminIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if(UserRole::where('userid', Auth::user()->id)->where('name', 'admin')->exists())
            {
                return $next($request);
            }
            else {
                abort(404);
            }
        }
        else {
            return redirect('/');
        }
    }
}
