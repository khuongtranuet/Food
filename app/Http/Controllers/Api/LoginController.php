<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\SessionUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function login(Request $request) {
        $checkLogin = array();
        if (isset($request->email)) {
            $checkLogin['email'] = $request->email;
        }
        if (isset($request->mobile)) {
            $checkLogin['mobile'] = $request->mobile;
        }
        $checkLogin['password'] = $request->password;
        if (auth()->guard('customer')->attempt($checkLogin)) {
            $checkTokenExist = SessionUser::where('user_id', Auth::guard('customer')->id())->get();
            if (!isset($checkTokenExist->token)) {
                $session_user = [
                    'token' => Str::random(40),
                    'refresh_token' => Str::random(40),
                    'token_expired' => date('Y-m-d H:i:s', strtotime('+30 day')),
                    'refresh_token_expired' => date('Y-m-d H:i:s', strtotime('+360 day')),
                    'user_id' => Auth::guard('customer')->id(),
                ];
                SessionUser::insert($session_user);
            }else{
                $session_user = $checkTokenExist;
            }

            return response()->json([
                'code' => 200,
                'data' => $session_user,
                'meta' => []
            ], 200);
        }else{
            return response()->json([
                'code' => 401,
                'message' => 'Tài khoản hoặc mật khẩu sai!',
                'meta' => []
            ], 401);
        }
    }

    public function refresh_token(Request $request) {
        $token = $request->header('token');
        $checkTokenIsValid = SessionUser::where('token', $token)->first();
        if (!empty($checkTokenIsValid)) {
            if (strtotime($checkTokenIsValid->token_expired) < time()) {
                SessionUser::where('token', $token)->update([
                    'token' => Str::random(40),
                    'refresh_token' => Str::random(40),
                    'token_expired' => date('Y-m-d H:i:s', strtotime('+30 day')),
                    'refresh_token_expired' => date('Y-m-d H:i:s', strtotime('+360 day')),
                ]);
                $dataToken = SessionUser::where('id', $checkTokenIsValid->id)->get();

                return response()->json([
                    'code' => 200,
                    'message' => 'Refresh token thành công!',
                    'data' => $dataToken,
                    'meta' => []
                ], 200);
            }else{
                return response()->json([
                    'code' => 200,
                    'message' => 'Token chưa hết hạn!',
                    'data' => $checkTokenIsValid,
                    'meta' => []
                ], 200);
            }
        }

    }

    public function delete_token(Request $request) {
        $token = $request->header('token');
        $checkTokenIsValid = SessionUser::where('token', $token)->first();
        if (!empty($checkTokenIsValid)) {
            $checkTokenIsValid->delete();

            return response()->json([
                'code' => 200,
                'message' => 'Xóa token thành công',
                'meta' => []
            ], 200);
        }
    }
}
