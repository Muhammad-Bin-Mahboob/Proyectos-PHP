<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Requests\EventRequest;

class EventApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener eventos de la base de datos
        $eventos = Event::all();
        // Devolver como JSON
        return response()->json($eventos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }

    public function visible(Event $event)
    {
        //
    }
}
