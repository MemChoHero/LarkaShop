<?php

namespace App\Http\Controllers;

use App\Entities\UserEntity;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function __construct(private readonly AuthService $authService)
    {

    }

    public function getRegisterForm(Request $request): View
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request): RedirectResponse
    {
        $result = $this->authService->register(UserEntity::fromRequest($request));

        return redirect()->route('root')->with(['email' => $result->getEmail()]);
    }

    public function getLoginForm(Request $request): View
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if(Auth::attempt($validated)) {
            $request->session()->regenerate();
            return redirect()->route('root')->with(['email' => $validated['email']]);
        }

        return back()->withErrors([
            'auth' => 'Неверное имя пользователя или пароль.',
        ]);
    }
}
