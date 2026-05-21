<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AdminController;

// Home
Route::get('/', function () {
    return view('home');
})->name('home');

// Menu
Route::get('/menu',        [MenuController::class, 'index'])    ->name('menu.index');
Route::get('/menu/{slug}', [MenuController::class, 'category']) ->name('menu.category');

// Reservations
Route::get('/reservations',  [ReservationController::class, 'create']) ->name('reservations.create');
Route::post('/reservations', [ReservationController::class, 'store'])  ->name('reservations.store');

// Auth (login/logout only)
Auth::routes(['register' => false, 'reset' => false]);

// Admin routes (protected)
Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard',                          [AdminController::class, 'dashboard'])         ->name('dashboard');
    Route::post('/reservations/{reservation}/status', [AdminController::class, 'updateReservation']) ->name('reservations.update');
    Route::get('/menu',                               [AdminController::class, 'menuIndex'])         ->name('menu');
    Route::delete('/menu/{menuItem}',                 [AdminController::class, 'deleteMenuItem'])    ->name('menu.delete');
});