<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UEsController;
use App\Http\Controllers\ECsController;
use resources\views\UEs\create;
// use resources\views\ECs\create;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('interface/interface');
});
// Route::get('/UE', 'create') ->name('create');
Route::get('/UEs', function(){
    return view('UEs.create');
});
// Route::resource('UEs', UEsController::class);