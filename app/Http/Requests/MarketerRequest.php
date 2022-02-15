<?php

namespace App\Http\Requests;

use App\Marketer;
use App\User;
use Illuminate\Foundation\Http\FormRequest;

class MarketerRequest extends FormRequest
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
        $user_id = request()->input('user_id');

        return [
            'name' => 'required',
            'last_name' => 'required',
            'email' => "required | unique:users,email,{$user_id}",
            'phone' => "required | unique:users,phone,{$user_id}",
            'tel' => 'required',
            'address' => 'required',
            'national_code' => 'required',

        ];
    }


    public function messages()
    {
        return[
            'name.required'=>'فیلد نام خالی است',
            'last_name.required'=>'فیلد نام خانوادگی خالی است',
            'email.required'=>'فیلد ایمیل خالی است',
            'email.unique'=>' ایمیل برای شخص  دیگر ثبت شده است',
            'phone.unique'=>' موبایل برای شخص  دیگر ثبت شده است',
            'phone.required'=>'فیلد موبایل خالی است',
            'tel.required'=>'فیلد تلفن خالی است',
            'address.required'=>'فیلد آدرس خالی است',
            'national_code.required'=>'فیلد کد ملی خالی است',
        ];
    }
}
