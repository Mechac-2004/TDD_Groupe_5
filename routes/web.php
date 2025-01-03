<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UEsController;
use App\Http\Controllers\ECsController;
use resources\views\UEs\create;

Route::get('/', function () {
    return view('interface/interface');
});

Route::get('/UEs', [UEsController::class, 'create'])->name('UEs');
Route::post('/UEs', [UEsController::class, 'store'])->name('store');
Route::get('/liste', [UEsController::class, 'index'])->name('liste');
Route::get('/ues/{id}/edit_ue', [UEsController::class, 'edit'])->name('edit_ue');
Route::put('/ues/{id}/update_ue', [UEsController::class, 'update'])->name('update_ue');
Route::delete('/ues/{id}/destroy_ue', [UEsController::class, 'destroy'])->name('destroy_ue');


Route::get('/ECs', [ECsController::class, 'create'])->name('ECs');
Route::post('/ECs', [ECsController::class, 'store'])->name('store');
Route::get('/liste', [ECsController::class, 'index'])->name('liste');




Route::get('/Notes', [NoteController::class, 'create'])->name('Notes');




Route::get('/Etudiants', [EtudiantController::class, 'create'])->name('Etudiants');



Route::get('/Notes', [NoteController::class, 'create'])->name('Notes');
Route::post('/Notes', [NoteController::class, 'store'])->name('store_note');

