@extends('layout')

@section('title', 'Detalle del Jugador')

@section('content')
    @if ($player->avatar)
        <img src="{{ asset('images/players/' . $player->avatar) }}" alt="{{ $player->name }}" width="200"><br>
    @else
        <p>No hay foto disponible.</p>
    @endif

    <p><strong>Nombre:</strong> {{ $player->name }}</p>
    <p><strong>Twitter:</strong> {{ $player->twitter }}</p>
    <p><strong>Instagram:</strong> {{ $player->instagram }}</p>
    <p><strong>Twitch:</strong> {{ $player->twitch }}</p>
    <p><strong>Posicion:</strong> {{ $player->position }}</p>
    <p><strong>Age:</strong> {{ $player->age }}</p>

    <a href="{{ route('players.index') }}">Volver a la lista de jugadores</a>
@endsection
