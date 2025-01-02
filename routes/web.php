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
Route::get('/UEs', function(){
// Route::get('/ues', function(){
    // return view('UEs.index');
    return view('UEs.create');
    
}) ->name('UEs');


Route::get('/UEs', [UEsController::class, 'index'])->name('ues.index');

Route::post('/UEs', [UEsController::class, 'store'])->name('store');

Route::get('/UEs', [UEsController::class, 'index'])->name('UEs');

Route::get('/ECs', function(){return view('ECs.create');}) ->name('ECs');
Route::post('/ECs', [ECsController::class, 'store'])->name('store_ecs');