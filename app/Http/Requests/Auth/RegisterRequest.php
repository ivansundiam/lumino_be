<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'first_name' => 'required|max:100|min:1',
            'middle_name' => 'nullable|max:100|min:1',
            'last_name' => 'required|max:100|min:1',
            'email' => 'required|max:255|min:1|unique:users,email',
            'password' => 'required|confirmed|min:8',

        ];
    }
}
