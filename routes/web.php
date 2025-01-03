<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UEsController;
use App\Http\Controllers\ECsController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('UEs', UEsController::class);
Route::resource('ECs', ECsController::class);
