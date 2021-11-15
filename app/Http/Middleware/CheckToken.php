<?php

namespace App\Http\Middleware;

use App\Models\SessionUser;
use Closure;

class CheckToken
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
        $token = $request->header('token');
        $checkTokenIsValid = SessionUser::where('token', $token)->first();
        if (empty($token)) {
            return response()->json([
                'code' => 401,
                'message' => 'Token không được gửi qua header',
            ], 401);
        } elseif (empty($checkTokenIsValid)) {
            return response()->json([
                'code' => 401,
                'message' => 'Token không hợp lệ',
            ], 401);
        }
        return $next($request);
    }
}
