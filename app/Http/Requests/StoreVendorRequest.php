<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVendorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'email' => 'required|email|max:255|unique:users,email', // Ensure the email is unique
        'password' => 'required', 
        'role' => 'required',
        ];
    }
    
    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
        'phone.required' => 'The phone number is required.',
        'email.required' => 'The email address is required.',
        'email.email' => 'The email address must be a valid email format.',
        'email.unique' => 'The email has already been taken.',
        'password.required' => 'A password is required.',
        'password.min' => 'Password must be at least 8 characters.', // Adjust this message
        'role.required' => 'The role is required.',
        ];
    }
}
