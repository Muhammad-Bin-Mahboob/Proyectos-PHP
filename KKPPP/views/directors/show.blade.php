@extends('layout')

@section('content')
<h1>{{ $director->name }}</h1>
<p>Fecha de nacimiento: {{ $director->birthday }}</p>
<p>Nacionalidad: {{ $director->nationality }}</p>

<h2>Películas dirigidas por {{ $director->name }}</h2>
<ul>
    @foreach ($director->movies as $movie)
        <li>
            <a href="{{ route('movies.show', $movie) }}">
                {{ $movie->title }}
            </a> ({{ $movie->year }})
        </li>
    @endforeach
</ul>
@endsection
