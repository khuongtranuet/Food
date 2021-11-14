<?php

namespace App\Http\Requests\Register;

use Illuminate\Foundation\Http\FormRequest;

class RegisterAddRequest extends FormRequest
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
                'unique:'.config('constants.db_table.TBL_CUSTOMERS').',mobile,'.$this->id ,
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
                'unique:'.config('constants.db_table.TBL_CUSTOMERS').',email,'.$this->id ,
            ],
        ];
    }

    public function attributes()
    {
        return [
            'fullname' => 'Họ và tên',
            'email' => 'Email',
            'mobile' => 'Số điện thoại',
            'password' => 'Mật khẩu',
            're_password' => 'Nhập lại nật khẩu',
        ];
    }


    public function messages()
    {
        return [
            'fullname.required' => ':attribute không được để trống!',
            'email.required' => ':attribute không được để trống!',
            'email.unique' => ':attribute đã tồn tại!',
            'mobile.required' => ':attribute không được để trống!',
            'mobile.unique' => ':attribute đã tồn tại!',
            'password.required' => ':attribute không được để trống!',
            're_password.required' => ':attribute không được để trống!',
            're_password.same' => ':attribute chưa khớp!',
        ];
    }
}
