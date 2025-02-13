@extends('layout')

@section('title','Contact')
@section('content')
    <form action="{{ route('messages.store') }}" method="post">
        @csrf
        <input value="muhammad" id='name' name='name' hidden></input>

        <label for="subject">Subject</label>
        <input type="text" name="subject" id="subject">

        <label for="message">Message</label>
        <input type="text" name="message" id="message">

        <input type="submit" value="Enviar">
    </form>
@endsection
