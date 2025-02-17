@extends('layout')

@section('title', 'Eventos')

@section('content')
    <h1>Detalles del Evento</h1>
    <div id="evento-detalle"></div>
@endsection

@push('scripts')
    <script>
        window.user = @json(auth()->user());
    </script>
    <script src="{{ asset('JavaScript/eventos2.js') }}"></script>
@endpush

