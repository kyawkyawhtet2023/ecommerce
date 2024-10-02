<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppProfileRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Allows all users to make this request (adjust logic if needed)
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'day_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Make nullable for updates
            'night_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Make nullable for updates
            'background_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Make nullable for updates
            'primary' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/|max:7', // Hex color validation
            'secondary' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/|max:7', // Hex color validation
            'name_color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/|max:7', // Hex color validation
            'title_color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/|max:7', // Hex color validation
            'price_color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/|max:7', // Hex color validation
            'body_color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/|max:7', // Hex color validation
            'email' => 'required|email|max:255', // Valid email
            'phone' => 'required|string|max:15', // Assuming phone numbers max length is 15
            'address' => 'required|string|max:255', // Address field
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Profile name is required.',
            'day_image.image' => 'Day image must be a valid image file.',
            'night_image.image' => 'Night image must be a valid image file.',
            'background_image.image' => 'Background image must be a valid image file.',
            'primary.regex' => 'Primary color must be a valid hex color code (e.g., #FFFFFF).',
            'secondary.regex' => 'Secondary color must be a valid hex color code (e.g., #FFFFFF).',
            'name_color.regex' => 'Name color must be a valid hex color code (e.g., #FFFFFF).',
            'title_color.regex' => 'Title color must be a valid hex color code (e.g., #FFFFFF).',
            'price_color.regex' => 'Price color must be a valid hex color code (e.g., #FFFFFF).',
            'body_color.regex' => 'Body color must be a valid hex color code (e.g., #FFFFFF).',
            'email.required' => 'Email is required.',
            'email.email' => 'Email must be a valid email address.',
            'phone.required' => 'Phone number is required.',
            'phone.max' => 'Phone number cannot be longer than 15 characters.',
            'address.required' => 'Address is required.',
        ];
    }
}
