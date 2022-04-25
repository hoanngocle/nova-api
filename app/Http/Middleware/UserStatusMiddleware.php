<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserStatusMiddleware
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
        // Verify user status
        if(auth()->check())
        {
            switch (auth()->user()->status)
            {
                case -1:
                    abort(response()->json([
                        'message' => 'User is disabled'
                    ], 403));

                case 0:
                    abort(response()->json([
                        'message' => 'User Registration not complete'
                    ], 403));

                case 2:
                    abort(response()->json([
                        'message' => 'Password Reset process not complete'
                    ], 403));

                default:
                    return $next($request);
                    break;
            }
        }
    }
}
