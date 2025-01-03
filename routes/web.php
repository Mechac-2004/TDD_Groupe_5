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
Route::post('/notes/store', [UEsController::class, 'store'])->name('Notes.store');
Route::get('/notes', [UEsController::class, 'index'])->name('Notes.index');
Route::get('/notes/{id}/edit', [UEsController::class, 'edit'])->name('Notes.edit');
Route::put('/notes/{id}', [UEsController::class, 'update'])->name('Notes.update');
Route::delete('/notes/{id}', [UEsController::class, 'destroy'])->name('Notes.destroy');




Route::get('/etudiants/create', [EtudiantController::class, 'create'])->name('Etudiants.create');
Route::post('/etudiants/store', [UEsController::class, 'store'])->name('Etudiants.store');
Route::get('/etudiants', [UEsController::class, 'index'])->name('Etudiants.index');
Route::get('/etudiants/{id}/edit', [UEsController::class, 'edit'])->name('Etudiants.edit');
Route::put('/etudiants/{id}', [UEsController::class, 'update'])->name('Etudiants.update');
Route::delete('/etudiants/{id}', [UEsController::class, 'destroy'])->name('Etudiants.destroy');



Route::get('/resultats/create', [NoteController::class, 'create'])->name('Resultats.create');
Route::post('/resultats/store', [UEsController::class, 'store'])->name('Resultats.store');
Route::get('/resultats', [UEsController::class, 'index'])->name('Resultats.index');
Route::get('/resultats/{id}/edit', [UEsController::class, 'edit'])->name('Resultats.edit');
Route::put('/resultats/{id}', [UEsController::class, 'update'])->name('Resultats.update');
Route::delete('/resultats/{id}', [UEsController::class, 'destroy'])->name('Resultats.destroy');


