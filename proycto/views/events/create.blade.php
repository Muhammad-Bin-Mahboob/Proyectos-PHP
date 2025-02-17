@extends('layout')

@section('title', 'Nuevo Evento')

@section('content')
    <h1>Nuevo Evento</h1>
    <form action="{{ route('events.store') }}" method="POST">
        @csrf

        <label for="name">Nombre del Evento:</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}"><br>

        <label for="description">Descripción:</label>
        <textarea name="description" id="description">{{ old('description') }}</textarea><br>

        <label for="location">Ubicación:</label>
        <textarea name="location" id="location">{{ old('location') }}</textarea><br>

        <label for="date">Fecha:</label>
        <input type="date" name="date" id="date" value="{{ old('date') }}"><br>

        <label for="hour">Hora:</label>
        <input type="time" name="hour" id="hour" value="{{ old('hour') }}"><br>

        <label for="type">Tipo de Evento:</label>
        <select name="type" id="type">
            <option value="official" {{ old('type') == 'official' ? 'selected' : '' }}>Oficial</option>
            <option value="exhibition" {{ old('type') == 'exhibition' ? 'selected' : '' }}>Exhibición</option>
            <option value="charity" {{ old('type') == 'charity' ? 'selected' : '' }}>Caridad</option>
        </select><br>

        <label for="tags">Etiquetas:</label>
        <textarea name="tags" id="tags">{{ old('tags') }}</textarea><br>

        <label for="visible">Visible:</label>
        <select name="visible" id="visible">
            <option value="1">True</option>
            <option value="0">False</option>
        </select><br>

        <button type="submit">Crear Evento</button>
    </form>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
@endsection

