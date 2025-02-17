@extends('layout')

@section('title', 'Modify Evento')

@section('content')
    <h1>Modificar Evento</h1>
    <form action="{{ route('events.update', $event->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Agrega esto para indicar que es una solicitud de actualización -->

        <label for="name">Nombre del Evento:</label>
        <input type="text" name="name" id="name" value="{{ $event->name }}"><br>

        <label for="description">Descripción:</label>
        <textarea name="description" id="description">{{ $event->description }}</textarea><br>

        <label for="location">Ubicación:</label>
        <textarea name="location" id="location">{{ $event->location }}</textarea><br>

        <label for="date">Fecha:</label>
        <input type="date" name="date" id="date" value="{{ $event->date }}"><br>

        <label for="hour">Hora:</label>
        <input type="time" name="hour" id="hour" value="{{ $event->hour }}"><br>

        <label for="type">Tipo de Evento:</label>
        <select name="type" id="type">
            <option value="official" {{ $event->type == 'official' ? 'selected' : '' }}>Oficial</option>
            <option value="exhibition" {{ $event->type == 'exhibition' ? 'selected' : '' }}>Exhibición</option>
            <option value="charity" {{ $event->type == 'charity' ? 'selected' : '' }}>Caridad</option>
        </select><br>

        <label for="tags">Etiquetas:</label>
        <textarea name="tags" id="tags">{{ $event->tags }}</textarea><br>

        <label for="visible">Visible:</label>
        <select name="visible" id="visible">
            <option value="1" {{ $event->visible ? 'selected' : '' }}>True</option>
            <option value="0" {{ !$event->visible ? 'selected' : '' }}>False</option>
        </select><br>

        <button type="submit">Actualizar Evento</button>
    </form>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
@endsection
