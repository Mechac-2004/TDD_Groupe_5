<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UEsController;
use App\Http\Controllers\ECsController;
use resources\views\UEs\create;

Route::get('/', function () {
    return view('interface/interface');
});

Route::get('/ues/create', [UEsController::class, 'create'])->name('UEs.create');
Route::post('/ues/store', [UEsController::class, 'store'])->name('UEs.store');
Route::get('/ues', [UEsController::class, 'index'])->name('UEs.index');
Route::get('/ues/{id}/edit', [UEsController::class, 'edit'])->name('UEs.edit');
Route::put('/ues/{id}', [UEsController::class, 'update'])->name('UEs.update');
Route::delete('/ues/{id}', [UEsController::class, 'destroy'])->name('UEs.destroy');


Route::get('/ecs/create', [ECsController::class, 'create'])->name('ECs.create');
Route::post('/ecs/store', [ECsController::class, 'index'])->name('ECs.store');
Route::post('/ecs', [ECsController::class, 'store'])->name('ECs.index');
Route::get('/ecs/{id}/edit', [UEsController::class, 'edit'])->name('ECs.edit');
Route::put('/ecs/{id}/update', [UEsController::class, 'update'])->name('ECs.update');
Route::delete('/ecs/{id}/destroy', [UEsController::class, 'destroy'])->name('ECs.destroy');




Route::get('/notes/create', [NoteController::class, 'create'])->name('Notes.create');




Route::get('/etudiants/create', [EtudiantController::class, 'create'])->name('Etudiants.create');



Route::get('/notes/create', [NoteController::class, 'create'])->name('Notes.create');
Route::post('/notes/store', [NoteController::class, 'store'])->name('Notes.store');



Route::get('/Resultats', [ResultatController::class, 'create'])->name('Resultats.create');

