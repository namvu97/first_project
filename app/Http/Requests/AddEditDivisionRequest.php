<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddEditDivisionRequest extends FormRequest
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
            'division_name' => 'required',
            'division_phone' => 'required|regex:/(0)+([0-9]{9})\b/',
        ];
    }

    public function messages()
    {
        return [
            'division_name.required' => 'Tên bộ phận làm việc không được để trống!',
            'division_phone.required' => 'Số điện thoại không được để trống!',
            'division_phone.regex' => 'Số điện thoại không đúng định dạng!',
        ];
    }
}
