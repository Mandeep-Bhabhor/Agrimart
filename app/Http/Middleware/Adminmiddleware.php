<?php

namespace App\Http\Middleware;

use Closure;
//use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Adminmiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() || Auth::user()->usertype !== 'admin') {
            // Redirect to login if not authenticated or not an admin
            return redirect()->route('login')->with('error', 'Unauthorized access');
        }
  return $next($request);
       
    }
}
