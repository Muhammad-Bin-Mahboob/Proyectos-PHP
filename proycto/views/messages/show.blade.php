@extends('layout')

@section('title', 'Detalle del Mensaje')

@section('content')
    <h1>Detalle del Mensaje</h1>

    <div>
        <strong>Nombre:</strong> {{ $message->name }}<br>
        <strong>Asunto:</strong> {{ $message->subject }}<br>
        <strong>Mensaje:</strong> {{ $message->text }}<br>
        <strong>Leído:</strong> {{ $message->readed }}<br>
    </div>

    <form action="{{ route('messages.destroy', $message->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Eliminar Mensaje</button>
    </form>

    <a href="{{ route('messages.index') }}">Volver a la lista de mensajes</a>
@endsection
