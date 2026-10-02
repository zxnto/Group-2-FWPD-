<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! auth()->check()) {
            return redirect()->route('login')->with('warning', 'Please login with your restaurant owner account.');
        }

        if (auth()->user()->role !== 'owner') {
            return redirect()->route('home')->with('error', 'Access denied. Restaurant owner privileges required.');
        }

        return $next($request);
    }
}
