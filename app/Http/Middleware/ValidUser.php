<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ValidUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
{
    if (Auth::check() && Auth::user()->role == $role) {
        return $next($request);  // Allow the request to continue
    } else {
        return redirect()->route('show.login');  // Redirect to login if user doesn't have the role
    }
}

}
