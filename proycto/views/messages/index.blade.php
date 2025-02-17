@extends('layout')

@section('title', 'Mensajes')

@section('content')
    <h1>Mensajes</h1>

    @if ($messages->isEmpty())
        <p>No hay mensajes disponibles.</p>
    @else
        <ul>
            @foreach ($messages as $message)
            <li>
                <a href="{{ route('messages.show', $message->id) }}">
                    <strong>Nombre:</strong> {{ $message->name }}<br>
                    <strong>Asunto:</strong> {{ $message->subject }}<br>
                </a><br>
            </li>
            @endforeach
        </ul>
    @endif
@endsection
