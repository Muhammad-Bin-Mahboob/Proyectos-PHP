@extends('layout')

@section('title', 'New Jugador')

@section('content')
    <h1>New Jugador</h1>
    <form action="{{ route('players.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}"><br>

        <label for="twitter">Twitter:</label>
        <input type="text" name="twitter" id="twitter" value="{{ old('twitter') }}"><br>

        <label for="instagram">Instagram:</label>
        <input type="text" name="instagram" id="instagram" value="{{ old('instagram') }}"><br>

        <label for="twitch">Twitch:</label>
        <input type="text" name="twitch" id="twitch" value="{{ old('twitch') }}"><br>

        <label for="avatar">Avatar:</label>
        <input type="file" name="avatar" id="avatar"><br>

        <label for="visible">Visible:</label>
        <select name="visible" id="visible">
            <option value="1">True</option>
            <option value="0">False</option>
        </select><br>

        <label for="position">Posicion:</label>
        <input type="text" name="position" id="position" value="{{ old('position') }}"><br>

        <label for="age">Edad:</label>
        <input type="number" name="age" id="age" value="{{ old('age') }}"><br>

        <button type="submit">Crear Jugador</button>
    </form>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
@endsection
