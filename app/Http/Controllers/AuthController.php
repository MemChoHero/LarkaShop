<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignInFormRequest;
use App\Http\Requests\SignUpRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function signIn(SignInFormRequest $request): RedirectResponse
    {
        if (!auth()->attempt($request->validated())) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('home'));
    }

    public function store(SignUpRequest $request): RedirectResponse
    {
        $user = User::query()
            ->create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => $request->get('password'),
            ]);

        auth()->login($user);
        event(new Registered($user));

        return redirect()->intended(route('home'));
    }

    public function logout(): RedirectResponse
    {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function login(): View
    {
        return view('auth.index');
    }

    public function register(): View
    {
        return view('auth.signup');
    }

    public function forgetPassword(): View
    {
        return view('auth.forgot_password');
    }

    public function resetPassword(): View
    {
        return view('auth.reset_password');
    }
}
