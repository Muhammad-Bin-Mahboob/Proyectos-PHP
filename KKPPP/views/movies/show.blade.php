@extends('layout')

@section('title', 'Ficha de la Película')

@section('content')
    {{-- <h1>Ficha de la película {{ $id }}</h1>
    <a href="{{ route('movies.edit', $id) }}">Editar película</a> --}}
    <h1>{{ $movie->title }}</h1>
    <p>Release year: {{ $movie->year }}</p>
    <p>Rating: {{ $movie->rating }} minutos</p>
    <p>Plot: {{ $movie->plot }}</p>

    <form action="{{ route('movies.destroy', $movie->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Eliminar Película</button>
    </form>
@endsection
