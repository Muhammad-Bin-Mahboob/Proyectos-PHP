@extends('layout')

@section('content')
    <form action="{{ route('login') }}" method="post">
        @csrf

        <label for="name">Nombre de usuario:</label>
        <input type="text" name="name" value="{{ old('name') }}"><br>

        <label for="password">Password:</label>
        <input type="password" name="password"><br>

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
