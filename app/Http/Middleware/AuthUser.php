<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthUser
{
    /**y
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (\Auth::user()->is_admin)
            return $next($request);
        if ($request->route('contacts')) {
            if (($request->route('contacts'))->user_id != \Auth::id()) {
                return abort(401);
            }
        } else if ($request->route('user')){
            if (($request->route('user'))->id != \Auth::id()) {
                return abort(401);
            }
        }
        return $next($request);
    }
}
