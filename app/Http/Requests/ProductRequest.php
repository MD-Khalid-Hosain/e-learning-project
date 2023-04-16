<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'product_name'=> 'required|unique:products,product_name',
            'category_id' => 'required|numeric',
            'product_multiple_image.*' => 'image',
            'main_image' => 'required|image',
            'product_description' => 'required',
            'price' => 'required|integer',
            'brand_id' => 'required|numeric',
            'header.*' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'product_name.required' => 'Please Enter Product Name',
            'category_id.required' => 'Select Category',
            'product_multiple_image.image' => 'Please upload valid image like png,jpeg etc',
            'main_image.required' => 'Upload thumbnail image',
            'main_image.image' => 'Please upload valid image like png,jpeg etc',
            'product_description.required' => 'This field is required',
            'price.required' => 'Please enter the product price',
            'brand_id.required'=> 'Please Select Brand of This Product',
            'category_id.numeric'=> 'Please Select a Category',
            'brand_id.required'=> 'Please Select a Brand',
        ];
    }
}
