<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;

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
        'email' => [
            'required',
            'string',
            'lowercase',
            'email',
            'max:255',
            Rule::unique(User::class)->ignore($this->vendor), // If using vendor directly
        ],
        'password' => 'nullable',
        'password_confirmation' => 'nullable|same:password',
        
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
        'password_confirmation.required' => 'A password is required.',
        ];
    }
}
