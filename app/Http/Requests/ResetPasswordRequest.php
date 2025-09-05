<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'password' => 'required|string|min:6|confirmed',
            'email' => 'required|string',
            'token' => 'required|string'
        ];
    }

    public function authorize(): bool
    {
        return auth()->guest();
    }
}
