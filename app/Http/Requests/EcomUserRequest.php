<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EcomUserRequest extends FormRequest
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
            'name' => 'required|regex:/^[\pL\s\-]+$/u',
            'mobile' => 'required|unique:ecom_users,mobile|numeric|digits:11',
            'email' => 'required|email|unique:ecom_users,email',
            'password' => 'required',
            'address' => 'required',

        ];
    }
    public function messages()
    {
        return [
            'name.alpha' => 'Shoud be alphabet',

            'mobile.required' => 'Please Give Your Mobile Number',
            'mobile.digits' => 'Moblie Number should be 11 digits',

            'email.email' => 'Please give a valid email',
            'email.required' => 'Email field is very important',
        ];
    }
}
