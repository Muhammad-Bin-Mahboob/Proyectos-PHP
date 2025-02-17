@extends('layout')

@section('content')
    <h1>Mi Cuenta</h1>
    <div>
        <div>
            <h3>Información del Usuario</h3>
            <p><strong>Nombre:</strong> {{ Auth::user()->name }}</p>
            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
            <p><strong>Birthday:</strong> {{ Auth::user()->birthday }}</p>
            <p><strong>Rol:</strong> {{ Auth::user()->rol }}</p>
            <!-- Puedes agregar más campos según sea necesario -->
        </div>

        <form action="{{ route('user.destroy', Auth::user()->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Eliminar cuenta</button>
        </form>

    </div>
@endsection
