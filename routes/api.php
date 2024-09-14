<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobOffersController;
use App\Http\Controllers\UserController;


Route::post('/login', [AuthController::class, 'login']);

//Ver usuarios
Route::get('/users', [UserController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    //Crear usuario
    Route::post('/register', [AuthController::class, 'register']);
    //Esitar Usuario
    Route::put('/users/{id}', [UserController::class, 'update']);
    //Eliminar usuario
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

    Route::put('/job-offers/{id}', [JobOffersController::class, 'update']);

});

Route::get('/job-offers', [JobOffersController::class, 'index']);
Route::post('/job-offers', [JobOffersController::class, 'store']);
Route::get('/job-offers/search', [JobOffersController::class, 'search']);
Route::delete('/job-offers/{id}', [JobOffersController::class, 'destroy']);


