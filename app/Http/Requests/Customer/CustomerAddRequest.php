<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class CustomerAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'fullname' => [
                'required',
            ],
            'mobile' => [
                'required',
                'unique:'.constants('db_table.TBL_CUSTOMERS'),
            ],
            'email' => [
                'required',
                'unique:'.constants('db_table.TBL_CUSTOMERS'),
            ],
            'gender' => [
                'gt:-1',
            ],
            'password' => [
                'required',
            ],
            'status' => [
                'gt:-1',
            ],
            'province' => [
                'gt:-1',
            ],
            'district' => [
                'gt:-1',
            ],
            'ward' => [
                'gt:-1',
            ],
            'address' => [
                'required',
            ],
            'fullname_address' => [
                'required',
            ],
            'mobile_address' => [
                'required',
            ],
            'type_address' => [
                'required',
            ],
            'status_address' => [
                'required',
            ],
        ];
    }

    public function attributes()
    {
        return [
            'fullname' => 'Họ và tên',
            'mobile' => 'Số điện thoại',
            'email' => 'Email',
            'gender' => 'Giới tính',
            'password' => 'Mật khẩu',
            'status' => 'Trạng thái',
            'province' => 'Tỉnh/Thành phố',
            'district' => 'Quận/Huyện',
            'ward' => 'Xã/Phường',
            'address' => 'Địa chỉ',
            'fullname_address' => 'Tên người nhận',
            'mobile_address' => 'Số điện thoại người nhận',
            'type_address' => 'Loại địa chỉ',
            'status_address' => 'Cài đặt địa chỉ',
        ];
    }


    public function messages()
    {
        return [
            'fullname.required' => ':attribute không được để trống!',
            'mobile.required' => ':attribute không được để trống!',
            'mobile.unique' => ':attribute đã tồn tại!',
            'email.required' => ':attribute không được để trống!',
            'password.required' => ':attribute không được để trống!',
            'email.unique' => ':attribute đã tồn tại!',
            'gender.gt' => ':attribute không được để trống!',
            'status.gt' => ':attribute không được để trống!',
            'province.gt' => ':attribute không được để trống!',
            'district.gt' => ':attribute không được để trống!',
            'ward.gt' => ':attribute không được để trống!',
            'address.required' => ':attribute không được để trống!',
            'fullname_address.required' => ':attribute không được để trống!',
            'mobile_address.required' => ':attribute không được để trống!',
            'type_address.required' => ':attribute không được để trống!',
            'status_address.required' => ':attribute không được để trống!',
        ];
    }
}
