<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParameterRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'specification_name' => ['required'],
            'category_id' => ['required'],
        ];
    }
    public function messages()
    {
        return [
            'specification_name.required' => 'Tên thông số không được để trống!',
            'category_id.required' => 'Vui lòng chọn danh mục sản phẩm cho thông số!',
        ];
    }
}
