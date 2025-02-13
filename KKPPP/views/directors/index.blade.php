@extends('layout')

@section('content')
<h1>Lista de Directores</h1>
<ul>
    @foreach ($directors as $director)
        <li>
            <a href="{{ route('directors.show', $director) }}">{{ $director->name }}</a>
        </li>
    @endforeach
</ul>
@endsection
