<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\MenuController;
use App\Http\Controllers\API\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function(){
    Route::post('/menu', [MenuController::class, 'store']);
    Route::put('/menu/{menuItem}', [MenuController::class, 'update']);
    Route::delete('/menu/{menuItem}', [MenuController::class, 'destroy']);
});

Route::get('/menu', [MenuController::class, 'index']);
Route::get('/menu/{menuItem}', [MenuController::class, 'show']);
Route::post('/login', [AuthController::class, 'login']);
