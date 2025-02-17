@extends('layout')

@section('content')
    <form action="{{ route('signup') }}" method="post">
        @csrf

        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}"><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}"><br>

        <label for="birthday">Fecha de nacimiento:</label>
        <input type="date" name="birthday" id="birthday" value="{{ old('birthday') }}"><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password"><br>

        <label for="password_confirmation">Repite Password:</label>
        <input type="password" name="password_confirmation" id="password_confirmation"><br>

        <input type="submit" value="Enviar">
    </form>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
@endsection
