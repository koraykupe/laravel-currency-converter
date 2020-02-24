<?php

namespace App\Http\Middleware;

use Closure;

class CheckIfAdmin
{
    /**
     * If logged in user is admin go ahead, otherwise return back to home
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->is_admin) {
            return $next($request);
        }
        return redirect(route('home'))->withErrors('You are not authorized to access this page!');
    }
}
