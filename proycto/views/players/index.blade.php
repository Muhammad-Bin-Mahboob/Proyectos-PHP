@extends('layout')

@section('title', 'Players')

@section('content')
    <h1>Jugadores del Equipo</h1>

    @if ($players->isEmpty())
        <p>No hay jugadores disponibles.</p>
    @else
        <ul>
            @foreach ($players as $player)
                <li>
                    <a href="{{ route('players.show', $player->id) }}">
                        <p><strong>Nombre:</strong> {{ $player->name }}</p>
                        @if ($player->avatar)
                            <img src="{{ asset('images/players/' . $player->avatar) }}" alt="{{ $player->name }}" width="200"><br>
                        @else
                            <p>No hay foto disponible.</p>
                        @endif
                    </a>

                    @if (Auth::check() && Auth::user()->rol === 'admin')
                        <form action="{{ route('players.visible', $player->id) }}" method="get">
                            @csrf
                            <button type="submit">
                                {{ $player->visible ? 'Ocultar' : 'Mostrar' }}
                            </button>
                        </form>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
@endsection

