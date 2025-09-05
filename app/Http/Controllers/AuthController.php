<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\SignInFormRequest;
use App\Http\Requests\SignUpRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function signIn(SignInFormRequest $request): RedirectResponse
    {
        if (!auth()->attempt($request->validated())) {
            return back()->withErrors([
                'email' => 'Неверное имя пользователя или пароль.',
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

    public function forgotPassword(ForgotPasswordRequest $request): RedirectResponse
    {
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['message' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function resetPassword(ResetPasswordRequest $request): RedirectResponse
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));
                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PasswordReset
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
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

    public function forgot(): View
    {
        return view('auth.forgot_password');
    }

    public function reset(string $token): View
    {
        return view('auth.reset_password', ['token' => $token]);
    }
}
