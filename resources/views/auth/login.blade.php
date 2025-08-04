<link rel="stylesheet" type="text/css" href="{{ asset('css/register.css') }}" />

<x-navbar />

<div class="container">
    <form method="post" action="{{ route('login') }}">
        <h1>Авторизация</h1>
        @csrf
        <input class="@error('email') invalid @enderror" name="email" placeholder="Email" />
        <input class="@error('password') invalid @enderror" name="password" placeholder="Пароль" />
        <button type="submit">Войти</button>
        @error('auth')
        {{ $message }}
        @enderror
        @error('email')
        {{ $message  }}
        @enderror
        @error('password')
        {{ $message }}
        @enderror
    </form>
</div>
