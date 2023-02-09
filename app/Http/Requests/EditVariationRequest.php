<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditVariationRequest extends FormRequest
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
            'variation_name' => 'required|max:255',
        ];
    }

    public function messages()
    {
        return [
            'variation_name.required' => 'Tên biến thể không được để trống',
            'variation_name.max' => 'Tên biến thể quá dài',
        ];
    }
}
