@extends('layout')

@section('title', 'Listado de Películas')

@section('content')
    <ul>
        @foreach ($movies as $movie)
            <li>
                {{ $movie->title }}
                (
                <a href="{{ route('directors.show', $movie->director) }}">
                    {{ $movie->director->name }}
                </a>
                )
            </li>
        @endforeach
    </ul>
@endsection
