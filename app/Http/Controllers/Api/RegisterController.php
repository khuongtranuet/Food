<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Register\RegisterAddRequest;
use App\Models\Customer;

class RegisterController extends Controller
{
    public function register(RegisterAddRequest $request) {
        $customer = array();
        $customer['fullname'] = $request->fullname;
        $customer['mobile'] = $request->mobile;
        $customer['email'] = $request->email;
        $customer['password'] = bcrypt($request->password);
        $customer['status'] = 0;
        $customer['type'] = 0;

        Customer::insert($customer);

        return response()->json([
            'code' => 201,
            'message' => 'Tạo tài khoản thành công!',
            'data' => $customer,
            'meta' => []
        ], 201);
    }
}
