<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignupRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function signupForm(): View
    {
        return view('auth.signup');
    }

    public function signup(SignupRequest $request): RedirectResponse
    {
        $user = new User();
        $user->username = $request->get('username');
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->birthday = $request->get('birthday');
        $user->save();

        Auth::login($user);

        return redirect()->route('users.account');
    }


    public function loginForm(): View
    {
        if (Auth::viaRemember()) {
            return view('auth.login')->with('message', 'Bienvenido de nuevo');
        } else if (Auth::check()) {
            return view('auth.login')->with('message', 'Ya estás autenticado.');
        } else {
            return view('auth.login');
        }
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->only('username', 'password');

        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('users.account');
        } else {
            $error = 'Error al acceder a la aplicación';
            return view('auth.login', compact('error'));
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('index');
    }
}
