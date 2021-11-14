<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
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
            'name' => [
                'required',
                'unique:'.config('constants.db_table.TBL_CATEGORIES').',name,'.$this->id ,
                'max:1000',
            ],
            'image' => [
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:2048',
            ],
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên danh mục',
            'image' => 'Ảnh',
        ];
    }


    public function messages()
    {
        return [
            'name.required' => ':attribute không được để trống!',
            'name.unique' => ':attribute đã tồn tại!',
            'name.max' => ':attribute không được quá 100 ký tự!',
            'image.image' => 'File tải lên không phải là ảnh!',
            'image.mimes' => 'Ảnh không đúng định dạng!',
            'image.max' => 'Kích thước tối đa của ảnh là 2MB!',
        ];
    }
}
