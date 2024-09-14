<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;
use App\Http\Controllers\AuthController;
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
    //Ver usuarios
    Route::get('/users', [UserController::class, 'index']);


    //Crear registro
    Route::post('/delivery', [DeliveryController::class, 'store']);
    //Esitar registro
    Route::put('/delivery/{id}', [DeliveryController::class, 'update']);
    //Eliminar usuario
    Route::delete('/delivery/{id}', [DeliveryController::class, 'destroy']);

});
//Crear usuario
Route::post('/register', [AuthController::class, 'register']);


//Ver delivery
Route::get('/delivery', [DeliveryController::class, 'index']);

