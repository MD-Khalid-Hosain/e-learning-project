<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminValidation extends FormRequest
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
            'first_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'last_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'mobile' => 'required|numeric|digits:11',
            'image' => 'image|required',
            'email' => 'required|email',
            'confirm_pwd'=> 'required',
            'new_pwd'=> 'required',

        ];
    }
    public function messages()
    {
        return [
            'first_name.alpha' => 'Shoud be alphabet',
            'last_name.alpha' => 'Shoud be alphabet',
            'mobile.required' => 'Please Give Your Mobile Number',
            'mobile.digits' => 'Moblie Number should be 11 digits',
            'image.image' => 'Please select a valid image',
            'image.required' => 'Please upload an image',
            'email.email' => 'Please give a valid email',
            'email.required' => 'Email field is very important',
            'role_name.required' => 'Please select role',
        ];
    }
}
