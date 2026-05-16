<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ReservationController;

// Home
Route::get('/', function () {
    return view('home');
});

// Menu
Route::get('/menu',          [MenuController::class, 'index'])    ->name('menu.index');
Route::get('/menu/{slug}',   [MenuController::class, 'category']) ->name('menu.category');

// Reservations
Route::get('/reservations',  [ReservationController::class, 'create']) ->name('reservations.create');
Route::post('/reservations', [ReservationController::class, 'store'])  ->name('reservations.store');