<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'category_name' => 'required',
            'section_id' => 'required|numeric',
            'category_image' => 'image',
            'slug' => 'required|alpha_dash|unique:categories,slug',
            'parent_id' => 'required|numeric',
            'description' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'category_name.required' => 'Category name is required',
            'section_id.required' => 'Section is required',
            'section_id.numeric' => 'Please Select a Section',
            'category_image.image' => 'Please select a valid image',
            'parent_id.numeric' => 'Please Select Parent Category',
        ];
    }
}
