<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\LoginController;

// Route::resource('message', MessageController::class);

Route::get('/messages/create', [MessageController::class, 'create'])->name('messages.create');
Route::get('/messages', [MessageController::class, 'store'])->name('messages.store');

// Rutas de registro
Route::get('signup', [LoginController::class, 'signupForm'])->name('signupForm');
Route::post('signup', [LoginController::class, 'signup'])->name('signup');

// Rutas de inicio de sesión
Route::get('login', [LoginController::class, 'loginForm'])->name('loginForm');
Route::post('login', [LoginController::class, 'login'])->name('login');

// Ruta de cierre de sesión
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

// Ruta de la cuenta de usuario (protegida por autenticación)
Route::get('account', function () {
    return view('users.account');
})->name('users.account')->middleware('auth');

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/Politics', function () {
    return view('Politics');
})->name('Politics');

Route::get('/Terms', function () {
    return view('Terms');
})->name('Terms');

Route::get('/UseConditions', function () {
    return view('UseConditions');
})->name('UseConditions');

Route::get('/Contact', function () {
    return view('Contact');
})->name('Contact');

Route::get('/whereAreWe', function () {
    return view('whereAreWe');
})->name('whereAreWe');

