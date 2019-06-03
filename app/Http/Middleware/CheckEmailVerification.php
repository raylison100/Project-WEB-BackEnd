<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckEmailVerification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ((isset($request->username)) && (isset($request->password)) ) {
            $credentials['email'] = $request->username;
            $credentials['password'] = $request->password;
            $credentials['active'] = 1;
            $credentials['deleted_at'] = null;

            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'message' => 'User not authorized.'
                ], 401);
            } else
                return $next($request);
        }else {
            return response()->json([
                'message' => 'Unauthorized, user not activated'
            ], 401);
        }
    }
}
