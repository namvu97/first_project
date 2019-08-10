<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'full_name' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Tên tài khoản không được để trống!',
            'username.alpha_dash' => 'Tên tài khoản chỉ có thể chứa chữ cái, số, dấu gạch ngang và dấu gạch dưới!',
            'username.min' => 'Tên tài khoản phải ít nhất 6 ký tự!',
            'username.max' => 'Tên tài khoản nhiều nhất 15 ký tự!',
            'email.required' => 'Tài khoản email không được để trống!',
            'email.email' => 'Tài khoản không đúng định dạng!',
            'profile_image.image' => 'Upload hình ảnh!',
            'profile_image.mimes' => 'Không đúng định dạng ảnh',
            'full_name.required' => 'Họ tên không được để trống!',
        ];
    }
}
