<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle($request, Closure $next, $role)
  {
    if (!Auth::check() || Auth::user()->role != $role) {
      abort(403);
    }

    if (Auth::check() && Auth::user()->role == $role) {
      return $next($request);
    }


    return redirect('/');
  }
}
