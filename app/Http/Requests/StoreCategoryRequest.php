<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'category_name' => 'required|unique:categories,category_name|max:255',
            'category_image' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'category_name.required' => 'Tên danh mục không được để trống',
            'category_name.unique' => 'Danh mục đã tồn tại',
            'category_name.max' => 'Tên danh mục quá dài',
            'category_image.required' => 'Ảnh danh mục không được để trống',
        ];
    }
}
