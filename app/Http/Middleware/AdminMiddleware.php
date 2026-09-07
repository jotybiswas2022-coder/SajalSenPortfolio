<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
    {

        if (!Auth::check()) {
            return redirect('/login');
        }
        if (!Auth::user()->is_admin) {
            return redirect('/'); 
        }

        return $next($request);
    }
}
