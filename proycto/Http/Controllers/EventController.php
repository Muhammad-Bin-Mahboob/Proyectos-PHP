<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Requests\EventRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('events.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->rol !== 'admin') {
            return Redirect::route('events.index');
        }
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request)
    {
        if (Auth::user()->rol !== 'admin') {
            return Redirect::route('events.index');
        }
        // Crear el evento manualmente
        $event = new Event();
        $event->name = $request->get('name');
        $event->description = $request->get('description');
        $event->location = $request->get('location');
        $event->date = $request->get('date');
        $event->hour = $request->get('hour');
        $event->type = $request->get('type');
        $event->tags = $request->get('tags');
        $event->visible = $request->get('visible');

        // Guardar el evento
        $event->save();

        // Redirigir con mensaje de éxito
        return redirect()->route('events.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        if (Auth::user()->rol !== 'admin') {
            return Redirect::route('events.index');
        }
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventRequest $request, Event $event)
    {
        if (Auth::user()->rol !== 'admin') {
            return Redirect::route('events.index');
        }
        // Actualizar los atributos del evento con los datos validados
        $event->name = $request->get('name');
        $event->description = $request->get('description');
        $event->location = $request->get('location');
        $event->date = $request->get('date');
        $event->hour = $request->get('hour');
        $event->type = $request->get('type');
        $event->tags = $request->get('tags');
        $event->visible = $request->get('visible');

        // Guardar los cambios en la base de datos
        $event->save();

        // Redireccionar a la vista de detalles del evento o a donde consideres necesario
        return redirect()->route('events.show', $event->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (Auth::user()->rol !== 'admin') {
            return Redirect::route('events.index');
        }
        $event = Event::findOrFail($id);
        $event->delete();
        return redirect()->route('events.index');
    }
}
