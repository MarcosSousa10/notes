<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\CheckisLogged;
use App\Http\Middleware\CheckisNotLogged;
use Illuminate\Support\Facades\Route;

Route::middleware(CheckisNotLogged::class)->group(function () {
    Route::get('/login', [AuthController::class, 'login']);
    Route::post('/loginSubmit', [AuthController::class, 'loginSubmit']);
});


Route::middleware(CheckisLogged::class)->group(function () {

    Route::get('/', [MainController::class, 'index']);
    Route::get('/newNote', [MainController::class, 'newNote']);
    Route::get('/logout', [AuthController::class, 'logout']);
});
