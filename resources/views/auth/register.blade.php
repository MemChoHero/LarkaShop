<link rel="stylesheet" type="text/css" href="{{ asset('/css/register.css') }} ">

<x-navbar />

<div class="container">
    <h1>Регистрация</h1>
    <form action="{{ route('register') }}" method="post">
        @csrf
        <input name="email" placeholder="Email" />
        <input name="password" placeholder="Пароль" />
        <button type="submit">Зарегистрироваться</button>
    </form>
</div>
