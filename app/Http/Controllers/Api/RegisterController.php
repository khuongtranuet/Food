<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Register\RegisterAddRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * URL: http://localhost:8000/api/v1/register
     *
     * @param RegisterAddRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) {
        $rules = [
            'fullname' => [
                'required',
            ],
            'mobile' => [
                'required',
                'unique:'.config('constants.db_table.TBL_CUSTOMERS').',mobile' ,
            ],
            'password' => [
                'required',
            ],
            're_password' => [
                'required',
                'same:password',
            ],
            'email' => [
                'required',
                'unique:'.config('constants.db_table.TBL_CUSTOMERS').',email' ,
            ],
        ];
        $attribute = [
            'fullname' => 'Họ và tên',
            'email' => 'Email',
            'mobile' => 'Số điện thoại',
            'password' => 'Mật khẩu',
            're_password' => 'Nhập lại nật khẩu',
        ];
        $message = [
            'fullname.required' => ':attribute không được để trống!',
            'email.required' => ':attribute không được để trống!',
            'email.unique' => ':attribute đã tồn tại!',
            'mobile.required' => ':attribute không được để trống!',
            'mobile.unique' => ':attribute đã tồn tại!',
            'password.required' => ':attribute không được để trống!',
            're_password.required' => ':attribute không được để trống!',
            're_password.same' => ':attribute chưa khớp!',
        ];
        $validator = Validator::make($request->all(), $rules, $message, $attribute);

        if ($validator->fails()) {
            return response()->json([
                'code' => 400,
                'message' => false,
                'errors' => $validator->messages(),
                'meta' => []
            ], 400);
        } else {
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
}
