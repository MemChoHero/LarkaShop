<form method="post" action="{{ route('logout') }}">
    @auth()
        @csrf
        @method('DELETE')

        <button type="submit">Выйти</button>
    @endauth
</form>
