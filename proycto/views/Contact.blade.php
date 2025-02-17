@extends('layout')

@section('title','Contact')
@section('content')
    <form action="{{ route('messages.store') }}" method="post">
        @csrf
        <input value="{{ Auth::user()->name }}" id='name' name='name' hidden></input>

        <label for="subject">Subject</label>
        <input type="text" name="subject" id="subject">

        <label for="text">Message</label>
        <input type="text" name="text" id="text">

        <input type="submit" value="Enviar">
    </form>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
@endsection
