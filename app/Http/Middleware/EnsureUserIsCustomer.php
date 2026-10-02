<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! auth()->check()) {
            return redirect()->route('login')->with('warning', 'Please login to continue.');
        }

        if (auth()->user()->role !== 'customer') {
            return redirect()->route('owner.dashboard')->with('info', 'Redirected to Owner Dashboard.');
        }

        return $next($request);
    }
}
