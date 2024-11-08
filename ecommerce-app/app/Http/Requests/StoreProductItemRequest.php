<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductItemRequest extends FormRequest
{
    public function authorize()
    {
        return true; 
    }

    public function rules()
    {
        return [
            'name.*' => 'required|string|max:255',
            'image.*' =>'required|string|max:255',
            'quantity.*' => 'required|integer|min:1',
            'price.*' => 'required|numeric|min:0',
            'sku.*' => 'required|string|max:255',
            'barcode.*' => 'nullable|string|max:255',
            'height.*' => 'nullable|numeric',
            'width.*' => 'nullable|numeric',
            'length.*' => 'nullable|numeric',
            'weight.*' => 'nullable|numeric',
        ];
    }

    public function messages()
    {
        return [
            'name.*.required' => 'The item name is required.',
            'quantity.*.required' => 'The item quantity is required.',
            'price.*.required' => 'The item price is required.',
            'sku.*.required' => 'The item SKU is required.',
        ];
    }
}

