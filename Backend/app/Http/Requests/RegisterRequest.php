<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return !! $this->ip();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|max:255',
            'last_name' => 'nullable|max:255',
            'user_name' => 'required|unique:users|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6|max:255',
        ];
    }
}
