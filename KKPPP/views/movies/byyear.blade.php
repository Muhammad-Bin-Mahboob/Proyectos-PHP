@extends('layout')

@section('content')

    @foreach($movies as $movie)
    <div>
        <h3>{{ $movie->title }}</h3>
    </div>
    @endforeach

@endsection

