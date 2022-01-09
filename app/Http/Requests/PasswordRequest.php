<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
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
            'password'=>'required|confirmed|min:9',

        ];
    }

    public function messages()
    {
        return [
            'password.required'=>'فیلد رمز عبور جدید الزامی است.'
            ,
            'password.min'=>"پسورد باید حداقل 9 کاراکتر باشد."
            ,
            'password.confirmed'=>'رمز عبور جدید با تکرار رمز عبور جدید یکسان نیست.'
        ];
    }


}
