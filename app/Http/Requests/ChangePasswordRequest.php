<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'old_password' => 'required|min:6|max:15|',
            'new_password' => 'required|min:6|max:15|',
            'new_password_repeat' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'old_password.required' => 'Mật khẩu cũ không được để trống!',
            'old_password.min' => 'Mật khẩu phải ít nhất 6 ký tự!',
            'old_password.max' => 'Mật khẩu nhiều nhất 15 ký tự!',
            'new_password.required' => 'Mật khẩu mới không được để trống!',
            'new_password.min' => 'Mật khẩu phải ít nhất 6 ký tự!',
            'new_password.max' => 'Mật khẩu nhiều nhất 15 ký tự!',
            'new_password_repeat.required' => 'Mật khẩu lặp lại không được để trống!',
        ];
    }
}
