<?php

namespace App\Entities;

use App\Models\User;
use Illuminate\Http\Request;

class UserEntity implements \JsonSerializable
{
    private string $email;
    private string $password;

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public static function fromModel(User $user): self
    {
        return new self(
            email: $user->email,
            password: $user->password
        );
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            email: $request->input('email'),
            password: $request->input('password')
        );
    }

    public function jsonSerialize(): array
    {
        return [
            "email" => $this->email,
            "password" => $this->password
        ];
    }
}
