<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'product_name' => 'required|unique:products,product_name|max:255',
            'category_id' => 'required',
            'product_img' => 'required',
            'product_desc' => 'required',
            // 'product_img_gallery[]' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'product_name.required' => 'Tên sản phẩm không được để trống',
            'product_name.unique' => 'Sản phẩm đã tồn tại',
            'product_name.max' => 'Tên sản phẩm quá dài',
            'category_id.required' => 'Danh mục không được để trống',
            'product_img.required' => 'Ảnh sản phẩm không được để trống',
            'product_desc.required' => 'Mô tả sản phẩm không được để trống',
            // 'product_img_gallery[].required' => 'Thư viện ảnh không được để trống',
        ];
    }
}
