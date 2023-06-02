<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name_cate' => request()->route('uuid') 
                    ? 'required|unique:tp_categories,name_cate,'.request()->route('uuid_category').',uuid_category'
                    : 'required|unique:tp_categories'
        ];
    }

    public function messages()
    {
        return [
            'name_cate.required' => 'Vui lòng nhập tên của nhãn hàng',
            'name_cate.unique' => 'Nhãn hàng này đã tồn tại',
        ];
    }
}
