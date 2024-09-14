<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobOffersController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DeliveryController;


Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    //Esitar Usuario
    Route::put('/users/{id}', [UserController::class, 'update']);
    //Eliminar usuario
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
    //Crear usuario
    Route::post('/register', [AuthController::class, 'register']);

    //Crear registro
    Route::post('/delivery', [DeliveryController::class, 'store']);
    //Ver delivery
    Route::get('/delivery', [DeliveryController::class, 'index']);


    Route::put('/job-offers/{id}', [JobOffersController::class, 'update']);

});
//Crear usuario
Route::post('/register', [AuthController::class, 'register']);
//Ver usuarios
Route::get('/users', [UserController::class, 'index']);

Route::post('/job-offers', [JobOffersController::class, 'store']);
Route::get('/job-offers/search', [JobOffersController::class, 'search']);
Route::delete('/job-offers/{id}', [JobOffersController::class, 'destroy']);


