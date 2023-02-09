<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
            'payment_name' => ['required', 'min:6'],
            'payment_content' => ['required', 'min:10'],
        ];
    }
    public function messages()
    {
        return [
            'payment_name.required' => 'Tên phương thức thanh toán không được để trống!',
            'payment_name.min' => 'Độ dài phương thức thanh toán phải lớn hơn 6 ký tự!',
            'payment_content.required' => 'Nội dung phương thức thanh toán không được để trống!',
            'payment_content.min' => 'Độ dài nội dung phươn thức thanh toán phải lớn hơn 10 ký tự!',
        ];
    }
}
