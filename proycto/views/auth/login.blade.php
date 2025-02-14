@extends('layout')

@section('content')
    <form action="{{ route('login') }}" method="post">
        @csrf

        <label for="username">Nombre de usuario:</label>
        <input type="username" name="username" value="{{ old('username') }}"><br>

        <label for="password">Password:</label>
        <input type="password" name="password"><br>

        <input type="submit" value="Enviar">
    </form>
@endsection
