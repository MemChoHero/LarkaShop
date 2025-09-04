<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class SignUpRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3',
            'email' => 'required|string|email|unique:users,email',
            'password' => ['required', 'confirmed', Password::defaults()],
            'password_confirmation' => ['required', 'min:8'],
        ];
    }

    public function authorize(): bool
    {
        return auth()->guest();
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'email' => str(request('email'))
                ->squish()
                ->lower()
                ->value()
        ]);
    }
}
