<?php

namespace App\Http\Requests\v1;

use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class RegisterAuthRequest extends FormRequest
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
            'given_name' => ['required_without:family_name', 'min:2', 'max:255', 'string'],
            'family_name' => ['required_without:given_name', 'min:2', 'max:255', 'string'],
            'name' => ['nullable', 'min:2', 'max:255', 'string'],
            'preferred_pronouns' => ['required', 'min:2', 'max:10', 'string'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', 'min:4', 'max:255', Password::defaults()],
            'profile_photo' => ['nullable', 'string', 'min:4', 'max:255']
        ];
    }
}
