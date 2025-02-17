<img src="{{ asset('images/falcons.png') }}" alt="logo" height="200">
<h1>Falcons</h1>
<div>
    <a href="{{ route('index') }}">Inicio<a>
    <a href="{{ route('players.index') }}">Jugadores<a>
    <a href="{{ route('events.index') }}">Eventos<a>
    <a href="{{ route('Contact') }}">Contacto<a>
    <a href="{{ route('whereAreWe') }}">Donde Estamos<a>
</div>

@auth
    <div>
        <a href="{{ route('logout') }}">Logout<a>
        <a href="{{ route('user.account') }}">Cuenta<a>
    </div>

    @if(auth()->user()->rol === 'admin')
        <div>
            <a href="{{ route('players.create') }}">Add Player<a>
            <a href="{{ route('events.create') }}">Add Event<a>
            <a href="{{ route('messages.index') }}">Messages<a>
        </div>
    @endif
@else
    <div>
        <a href="{{ route('signupForm') }}">Registro<a>
        <a href="{{ route('loginForm') }}">Login<a>
    </div>
@endauth
