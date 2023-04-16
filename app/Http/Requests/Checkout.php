<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Checkout extends FormRequest
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
            'customer_name'=> 'required',
            'customer_email'=> 'required',
            'address1'=> 'required',
            'city'=> 'required',
            'customer_mobile'=> 'required|numeric|digits:11',
            'payment_method'=> 'required',
        ];
    }
    public function messages()
    {
        return [
            'customer_name.required' => 'Name is required',
            'customer_email.required' => 'Email is required',
            'address1.required' => 'Delivery Address is required',
            'city.required' => 'Select City',
            'customer_mobile.required' => 'Mobile number is required',
            'customer_mobile.digits' => 'Mobile number should be 11 digits',
            'payment_method.required' => 'Please Select Payment Method',
        ];
    }
}
