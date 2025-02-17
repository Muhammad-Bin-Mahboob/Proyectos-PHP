<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\EventController;

Route::get('/cuenta', [UserController::class, 'show'])->name('user.account')->middleware('auth');
Route::delete('/cuenta/{user}', [UserController::class, 'destroy'])
    ->name('user.destroy')
    ->middleware('auth');

Route::get('/events', function () {
    return view('events.index');
})->name('events.index');
Route::get('/events/create', [EventController::class, 'create'])->name('events.create')->middleware('auth');
Route::post('/events/store', [EventController::class, 'store'])->name('events.store')->middleware('auth');
Route::get('/events/show/{id}', [EventController::class, 'show'])->name('events.show')->middleware('auth');

Route::get('/events/edit/{event}', [EventController::class, 'edit'])->name('events.edit')->middleware('auth');
Route::get('/events/{id}/destroy', [EventController::class, 'destroy'])->name('events.destroy')->middleware('auth');
Route::put('/events/update/{event}', [EventController::class, 'update'])->name('events.update')->middleware('auth');

Route::get('/players', [PlayerController::class, 'index'])->name('players.index');

Route::post('/players/store', [PlayerController::class, 'store'])->name('players.store')->middleware('auth');
Route::get('/players/create', [PlayerController::class, 'create'])->name('players.create')->middleware('auth');

Route::get('/players/{player}', [PlayerController::class, 'show'])->name('players.show')->middleware('auth');
Route::get('/players/{player}/visible', [PlayerController::class, 'visible'])
    ->name('players.visible')
    ->middleware('auth');

Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
Route::get('/messages/index', [MessageController::class, 'index'])->name('messages.index');
Route::get('/messages/{message}', [MessageController::class, 'show'])->name('messages.show');
Route::resource('messages', MessageController::class);

Route::get('signup', [LoginController::class, 'signupForm'])->name('signupForm')->middleware('guest');
Route::post('signup', [LoginController::class, 'signup'])->name('signup')->middleware('guest');

Route::get('login', [LoginController::class, 'loginForm'])->name('loginForm')->middleware('guest');
Route::post('login', [LoginController::class, 'login'])->name('login')->middleware('guest');

Route::get('logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

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
})->name('Contact')->middleware('auth');

Route::get('/whereAreWe', function () {
    return view('whereAreWe');
})->name('whereAreWe');

