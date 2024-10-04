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

    Route::get('/', [MainController::class, 'index'])->name('home');
    Route::get('/newNote', [MainController::class, 'newNote'])->name('new');
    Route::get('/editNote/{id}', [MainController::class, 'editNote'])->name('edit');
    Route::get('/deleteNote/{id}', [MainController::class, 'deleteNote'])->name('delete');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
