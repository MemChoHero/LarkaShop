<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ForgotPasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email:dns',
        ];
    }

    public function authorize(): bool
    {
        return auth()->guest();
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Поле почты обязательно к заполнению',
            'email.email' => 'Неверный формат почты',
        ];
    }
}
