<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name'=>'required',
            'last_name'=>'required',
            'email'=>'required|unique:users',
            'phone'=>'required',
        ];
    }


    public function messages()
    {
        return [
            'name.required'=>'فیلد نام الزامی است',
            'last_name.required'=>'فیلد نام خانوادگی الزامی است',
            'email.required'=>'فیلد ایمیل الزامی است',
            'email.unique'=>'ایمیل ثبت شده است',
            'phone.required'=>'فیلد تلفن الزامی است',
        ];
    }
}
