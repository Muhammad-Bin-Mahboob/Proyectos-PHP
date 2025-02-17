<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlayerRequest;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check() && Auth::user()->rol === 'admin') {
            // Los administradores siempre ven todos los jugadores
            $players = Player::all();
        } else {
            $players = Player::where('visible', true)
                        ->orderBy('created_at', 'desc')
                        ->get();
        }

        // Pasar los jugadores a la vista
        return view('players.index', compact('players'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::check() && Auth::user()->rol === 'admin') {
            return view('players.create');
        }
        return redirect()->route('players.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlayerRequest $request)
    {
        if (Auth::check() && Auth::user()->rol === 'admin') {
            $player = new Player();

            // Asignar los valores del request a los campos del jugador
            $player->name = $request->get('name');
            $player->twitter = $request->get('twitter');
            $player->instagram = $request->get('instagram');
            $player->twitch = $request->get('twitch');
            $player->visible = $request->get('visible');
            $player->position = $request->get('position');
            $player->age = $request->get('age');

            // Verificar si se ha subido una imagen
            if ($request->hasFile('avatar')) {
                // Obtener el nombre de la imagen y generar el nuevo nombre
                $avatar = $request->file('avatar');
                $avatarName = strtolower($player->name . '_' . $player->position . '_' . $player->twitter . '_' . $player->instagram . '_' . $player->age);

                // Crear el nombre con la extensión de la imagen original
                $avatarName = $avatarName . '.' . $avatar->getClientOriginalExtension();

                // Guardar la imagen en la carpeta 'public/images/players'
                $avatar->move(public_path('images/players'), $avatarName);

                // Asignar el nombre de la imagen al campo 'avatar'
                $player->avatar = $avatarName;
            }

            // Guardar el jugador en la base de datos
            $player->save();
            return redirect()->route('players.index');
        }else{
            return redirect()->route('players.index');
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(Player $player)
    {
        return view('players.show', compact('player'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Player $player)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Player $player)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Player $player)
    {
        //
    }

    public function visible(Player $player)
    {
        if (Auth::check() && Auth::user()->rol === 'admin') {
            $player->visible = !$player->visible;
            $player->save();
        }
        return redirect()->route('players.index');
    }

}
