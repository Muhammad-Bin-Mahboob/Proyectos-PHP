<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Requests\MessageRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Verificar si el usuario es administrador
        if (Auth::user()->rol !== 'admin') {
            return Redirect::route('index')->with('error', 'No tienes permiso para acceder a esta página.');
        }

        $messages = Message::orderBy('created_at', 'desc')->get();
        return view('messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // No es necesario modificar este método si no se usa
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MessageRequest $request)
    {
        $message = new Message();
        $message->name = $request->get('name');
        $message->subject = $request->get('subject');
        $message->text = $request->get('text');
        $message->save();

        // Redirigir con un mensaje de éxito
        return Redirect::route('messages.index')->with('success', 'Mensaje creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        // Verificar si el usuario es administrador
        if (Auth::user()->rol !== 'admin') {
            return Redirect::route('index')->with('error', 'No tienes permiso para acceder a esta página.');
        }

        // Marcar el mensaje como leído
        $message->readed = true;
        $message->save();

        // Redirigir a la vista messages/show con el mensaje
        return view('messages.show', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        // No es necesario modificar este método si no se usa
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        // No es necesario modificar este método si no se usa
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        // Verificar si el usuario es administrador
        if (Auth::user()->rol !== 'admin') {
            return Redirect::route('index')->with('error', 'No tienes permiso para realizar esta acción.');
        }

        // Eliminar el mensaje
        $message->delete();
        return Redirect::route('messages.index')->with('success', 'Mensaje eliminado correctamente.');
    }
}
