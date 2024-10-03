<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('main');
});
Route::get('/about', function () {
    echo 'About us';
});
Route::get('/Main/{value}',[MainController::class, 'index']);
