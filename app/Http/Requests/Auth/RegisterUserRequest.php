<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class RegisterUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'phone_number' => ['required', 'numeric', 'unique:' . User::class, 'regex:/^(09|989|9)\d{9}/i'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Enter your name.',
            'name.max' => 'Your name is too long.',
            'name.min' => 'Your name is too short.',
            'email.required' => 'Enter your email.',
            'email.max' => 'Your email is too long.',
            'email.unique' => 'This email is already exists.',
            'phone_number.required' => 'Enter your phone number.',
            'phone_number.numeric' => 'Phone number must be numeric.',
            'phone_number.unique' => 'This phone number is already exists.',
            'phone_number.regex' => 'This phone number is invalid.',
            'password.required' => 'Enter password.',
        ];
    }
}
