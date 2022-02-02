<?php

use App\Http\Controllers\API\CountryController;
use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
Route::group(['prefix' => 'countries', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [CountryController::class, 'index']);
    Route::post('add', [CountryController::class, 'add']);
    Route::get('edit/{id}', [CountryController::class, 'edit']);
    Route::post('update/{id}', [CountryController::class, 'update']);
    Route::delete('delete/{id}', [CountryController::class, 'delete']);
});

