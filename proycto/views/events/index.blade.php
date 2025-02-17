@extends('layout')

@section('title', 'Eventos')

@section('content')
    <h1>Lista de Eventos</h1>
    <div id="eventos-lista"></div>
@endsection

@push('scripts')
    <script>
        window.user = @json(auth()->user());
    </script>
    <script src="{{ asset('JavaScript/eventos.js') }}"></script>
@endpush



