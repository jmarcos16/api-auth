<?php

namespace App\Http\Middleware;

use App\Http\Controllers\ResponseController;
use App\Support\ResponseApi;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{


  use ResponseApi;
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next, string $permission)
  {

    if (Auth::user()->cant($permission)) {
      return $this->error('Not authorized', 401);
    }

    return $next($request);
  }
}
