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
            $customer = Customer::where('email', $request->email)->get();
        }
        if (isset($request->mobile)) {
            $checkLogin['mobile'] = $request->mobile;
            $customer = Customer::where('mobile', $request->mobile)->get();
        }
        $checkLogin['password'] = $request->password;

        if (auth()->guard('customer')->attempt($checkLogin)) {
            $checkTokenExist = SessionUser::where('user_id', $customer[0]->id)->get();
            if (empty($checkTokenExist)) {
                $session_user = [
                    'token' => Str::random(40),
                    'refresh_token' => Str::random(40),
                    'token_expired' => date('Y-m-d H:i:s', strtotime('+30 day')),
                    'refresh_token_expired' => date('Y-m-d H:i:s', strtotime('+360 day')),
//                    'user_id' => auth()->id(),
                    'user_id' => $customer[0]->id,
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
}
