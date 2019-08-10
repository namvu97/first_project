<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FindPasswordRequest extends FormRequest
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
            'username' => 'required|alpha_dash|min:6|max:15|',
            'email' => 'required|email',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Username không được để trống!',
            'username.alpha_dash' => 'Tên người dùng chỉ có thể chứa chữ cái, số, dấu gạch ngang và dấu gạch dưới!',
            'username.min' => 'Username phải ít nhất 6 ký tự!',
            'username.max' => 'Username nhiều nhất 15 ký tự!',
            'email.required' => 'Email không được để trống!',
            'email.email' => 'Email không đúng định dạng!',
        ];
    }
}
