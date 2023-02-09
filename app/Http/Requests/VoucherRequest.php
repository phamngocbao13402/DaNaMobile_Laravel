<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VoucherRequest extends FormRequest
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
            'voucher_code' => ['required', 'min:6'],
            'voucher_value' => ['required'],
            'voucher_numberof' => ['required', 'integer'],
            'voucher_status' => ['required'],
        ];
    }
    public function messages()
    {
        return [
            'voucher_code.required' => 'Mã giảm giá không được để trống!',
            'voucher_code.min' => 'Mã giảm giá phải lớn hơn 6 ký tự!',
            'voucher_value.required' => 'Giá trị của mã giảm giá không được để trống!',
            'voucher_numberof.required' => 'Số lượng mã giảm giá không được để trống!',
            'voucher_numberof.integer' => 'Số lượng mã giảm giá phải là kiểu số!',
            'voucher_status.required' => 'Trạng thái mã giảm giá không được để trống!',
        ];
    }
}
