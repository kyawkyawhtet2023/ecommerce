<?php 

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize()
    {
        return true; 
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:category,id',
            'highlight' => 'nullable|string',
            'description' => 'nullable|string',
            'image_1' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'image_3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'image_4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_5' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',  
            'image_6' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
            
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The product name is required.',
            'category_id.required' => 'Please select a category.',
            'image_1.required' => 'The main product image is required.',
        ];
    }
}
