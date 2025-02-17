<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EventApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::get('/events', [EventApiController::class, 'index']);
Route::get('/events', [EventApiController::class, 'index']);
//Route::post('/events/store', [EventApiController::class, 'store'])->name('events.store');

// Route::get('/events/{event}', [EventApiController::class, 'show'])->name('events.show')->middleware('auth');
// Route::get('/events/{event}/visible', [EventApiController::class, 'visible'])
// ->name('events.visible')
//->middleware('auth');

