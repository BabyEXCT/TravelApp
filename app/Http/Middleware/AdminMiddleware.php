<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        // Check if the user is authenticated and has 'admin' user_type
        if (!Auth::check() || Auth::user()->user_type !== 'admin') {
            return redirect('/'); // Redirect to homepage or an unauthorized page
        }

        return $next($request);
    }
}
