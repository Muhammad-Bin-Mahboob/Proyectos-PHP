<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('contacto', function () {
    return view('Contact');
})->name('contacto');
